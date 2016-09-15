<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use Auth;
use Session;
use Storage;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Upload;
use CoderStudios\Requests\UploadRequest;

class PicsController extends BaseController
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
	public function __construct(Request $request, Cache $cache, Upload $upload)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->upload = $upload;
		$this->middleware('auth');
	}

	public function index($ad = '')
	{
		$key = $this->getKeyName(__function__ . '|' . $ad);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
            if (!empty($ad)) {
                $pics = $this->upload->mine(Auth::user()->user_id)->where('folder',$ad)->orderBy('created_at','DECS')->paginate();
            } else {
                $pics = $this->upload->mine(Auth::user()->user_id)->orderBy('created_at','DECS')->paginate();
            }
			$vars = [
				'user'      => Auth::user(),
                'pics'      => $pics,
                'ad'        => $ad,
				'all_pics'  => $this->upload->mine(Auth::user()->id)->get(),
			];
			$view = view('pages.pics-index', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

    public function delete($ad = '', $id = '')
    {
        $upload = $this->upload->mine(Auth::user()->id)->where('id',$ad)->first();
        if ($id) {
            $upload = $this->upload->mine(Auth::user()->id)->where('folder',$ad)->where('id',$id)->first();
        }
        if ($upload && $upload->user_id == Auth::user()->id) {
            $path = '';
            if ($upload->folder) {
                $path = $upload->folder;
            } else {
                $path = $upload->user_id;
            }
            Storage::delete(storage_path('app/uploads/'.$path) .'/'.$upload->maskname . '.' . $upload->extension);
            $upload->delete();
            if (!empty($id)) {
                return redirect()->route('pic.ad.index', ['ad' => $ad])->with('success_message','Pic deleted');
            } else {
                return redirect()->route('pic.index')->with('success_message','Pic deleted');
            }
        }
        return redirect()->route('dashboard');
    }

	public function save(UploadRequest $request)
	{
		$files = $request->file('file');
        $json = [];
        foreach($files as $file) {
            $data = [];
            $data['filename'] = $file->getClientOriginalName();
            $data['maskname'] = md5($file->getClientOriginalName() . date('Y-m-d H:i:s'));
            $data['extension'] = $file->guessExtension();
            $data['size'] = $file->getClientSize();
            $data['user_id'] = Auth::user()->user_id;
            $data['folder'] = $request->input('folder') != '' ? $request->input('folder') : '';
            if ($file->isValid()) {
                $upload = $this->upload->create($data);
                $result = $file->move(storage_path('app/uploads/'.$data['user_id']), $data['maskname'] . '.' . $data['extension']);
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
            return response()->json(['result' => true, 'path' => route('pic.index') ]);
        }
        return response()->json(['result' => false, 'path' => route('pic.index') . '?result=false']);
	}
}