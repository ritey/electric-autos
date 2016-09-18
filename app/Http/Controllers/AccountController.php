<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use Auth;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Upload;

class AccountController extends BaseController
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
	public function __construct(Request $request, Cache $cache, Resource $resource, Upload $upload)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->resource = $resource;
		$this->upload = $upload;
		$this->middleware('auth');
	}

	public function dashboard()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'user' => Auth::user(),
				'ads' => $this->resource->mine(Auth::user()->id)->paginate(),
				'all_ads' => $this->resource->mine(Auth::user()->id)->get(),
				'all_pics' => $this->upload->mine(Auth::user()->id)->get(),
			];
			$view = view('pages.dashboard', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function upgrade()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'user' => Auth::user(),
				'ads' => $this->resource->mine(Auth::user()->id),
			];
			$view = view('pages.upgrade', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function processUpgrade()
	{

	}
}