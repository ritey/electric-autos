<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Http\Controllers\Admin\BaseController;
use CoderStudios\Models\Resources;
use CoderStudios\Requests\AdRequest;

class AdsController extends BaseController
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
	public function __construct(Request $request, Cache $cache, Resources $resource)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->resource = $resource;
	}

	public function index()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'ads' => $this->resource->orderBy('id','desc')->paginate(),
			];
			$view = view('admin.pages.ads-index', compact('vars'))->render();
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
				'ad' => $this->resource->where('id',$id)->first(),
			];
			$view = view('admin.pages.ad-edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function update(AdRequest $request, $id)
	{
		$data = $request->only();
		$ad = $this->resource->where('id',$id)->first();
		$ad->update($data);
  		$this->clearAdminCache();
		return redirect()->route('admin.ads')->with('success_message','Ad updated');
	}
}