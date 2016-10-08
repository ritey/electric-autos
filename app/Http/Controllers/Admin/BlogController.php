<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Http\Controllers\BaseController;
use CoderStudios\Models\Articles;
use CoderStudios\Requests\PostRequest;

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
	public function __construct(Request $request, Cache $cache, Articles $articles)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->article = $articles;
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
		$data = $request->only();
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
}