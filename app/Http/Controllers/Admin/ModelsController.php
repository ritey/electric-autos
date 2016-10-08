<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Http\Controllers\BaseController;
use CoderStudios\Models\Makes;
use CoderStudios\Models\Models;
use CoderStudios\Requests\ModelsRequest;

class ModelsController extends BaseController
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
	public function __construct(Request $request, Cache $cache, Models $models, Makes $makes)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->models = $models;
		$this->makes = $makes;
}

	public function index()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'models' => $this->models->orderBy('make_id','asc')->orderBy('name','asc')->paginate(),
			];
			$view = view('admin.pages.models-index', compact('vars'))->render();
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
				'model' => $this->models->newInstance(),
				'makes' => $this->makes->orderBy('name','ASC')->get(),
			];
			$view = view('admin.pages.models-create', compact('vars'))->render();
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
				'model' => $this->models->where('id',$id)->first(),
			];
			$view = view('admin.pages.models-edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function update(ModelsRequest $request, $id)
	{
		$data = $request->only();
		$ad = $this->models->where('id',$id)->first();
		$ad->update($data);
		foreach(['edit','create','index'] as $name) {
			$this->cache->forget($this->getKeyName($name));
		}
		return redirect()->route('admin.models')->with('success_message','Models updated');
	}

	public function store(ModelsRequest $request)
	{
		$data = $request->only('name','make_id');
		$this->models->create($data);
		foreach(['edit','create','index'] as $name) {
			$this->cache->forget($this->getKeyName($name));
		}
		return redirect()->route('admin.models')->with('success_message','Model created');
	}
}