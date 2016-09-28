<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
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
	public function __construct(Request $request, Cache $cache)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
	}

	public function home()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [

			];
			$view = view('admin.pages.home', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}
}