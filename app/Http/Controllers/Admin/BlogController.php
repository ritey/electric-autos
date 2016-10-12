<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Http\Controllers\BaseController;
use CoderStudios\Models\Articles;
use CoderStudios\Requests\PostRequest;
use CoderStudios\Library\Upload;
use CoderStudios\Requests\UploadRequest;
use Auth;
use Session;
use Storage;

class BlogController extends BaseController
{

    /**
     * Laravel Request Repository
     *
     * @var object
     */
    protected $request;

    /**
     * Laravel Cache Repository
     *
     * @var object
     */
    protected $cache;

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache, Articles $articles, Upload $upload)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->article = $articles;
		$this->upload = $upload;
	}

	public function index()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'posts' => $this->article->orderBy('id','desc')->paginate(),
			];
			$view = view('admin.pages.posts-index', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function create()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'post' => $this->article->newInstance(),
				'action_url' => route('admin.posts.store'),
			];
			$view = view('admin.pages.posts-edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function edit($id)
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'post' => $this->article->where('id',$id)->first(),
				'action_url' => route('admin.posts.update', ['id' => $id]),
			];
			$view = view('admin.pages.posts-edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function update(PostRequest $request, $id)
	{
		$data = $request->only($this->article->getFillable());
		$post = $this->article->where('id',$id)->first();
		$post->update($data);
		return redirect()->route('admin.posts')->with('success_message','Post updated');
	}

	public function store(PostRequest $request)
	{
		$data = $request->only($this->article->getFillable());
		$this->article->create($data);
		return redirect()->route('admin.posts')->with('success_message','Post created');
	}

	public function images($article = '')
	{
		$key = $this->getKeyName(__function__ . '|' . $article);
        if ($this->request->input('page')) {
            $key = $this->getKeyName(__function__ . '|' . $article . '|' . $this->request->input('page'));
        }
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
            $pics = $this->upload->article($article)->orderBy('created_at','DECS')->paginate();
			$vars = [
				'user'      => Auth::user(),
                'pics'      => $pics,
                'article'   => $article,
				'all_pics'  => $this->upload->mine(Auth::user()->id)->get(),
			];
			$view = view('admin.pages.pics-index', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function saveImage(UploadRequest $request)
	{
		$files = $request->file('file');
        $json = [];
        foreach($files as $file) {
            $data = [];
            $data['filename'] = $file->getClientOriginalName();
            $data['maskname'] = md5($file->getClientOriginalName() . date('Y-m-d H:i:s'));
            $data['extension'] = $file->guessExtension();
            $data['size'] = $file->getClientSize();
            $data['article_id'] = $request->input('folder');
            $data['user_id'] = Auth::user()->user_id;
            $data['folder'] = 'site';
            if ($file->isValid()) {
                $upload = $this->upload->create($data);
                $result = $file->move(storage_path('app/uploads/site'), $data['maskname'] . '.' . $data['extension']);
                $json[] = ['result' => true];
            } else {
                $json[] = ['result' => false];
            }
        }
        $failed = 0;
        $success = 0;
        foreach($json as $item) {
            if (!$item['result']) {
                $failed++;
            }
        }
        $success = (count($json)-$failed);
        $message = $success . ' ' . str_plural('file',$success) . ' uploaded.';
        if ($failed > 0) {
            $message = $message . ' ' . $failed . ' ' . str_plural('file',$failed) . ' failed to upload.';
        }
        if ($success) {
            Session::put('success_message',$message);
            return response()->json(['result' => true, 'path' => route('admin.pic.index') ]);
        }
        return response()->json(['result' => false, 'path' => route('admin.pic.index') . '?result=false']);
	}

    public function deleteImage($id = '')
    {
        $upload = $this->upload->mine(Auth::user()->user_id)->where('id',$id)->first();
        if ($upload && $upload->user_id == Auth::user()->user_id) {
            $path = 'site';
            Storage::delete(storage_path('app/uploads/'.$path) .'/'.$upload->maskname . '.' . $upload->extension);
            $upload->delete();
            return redirect()->route('admin.pic.index')->with('success_message','Pic deleted');
        }
        return redirect()->route('admin.pic.index');
    }
}