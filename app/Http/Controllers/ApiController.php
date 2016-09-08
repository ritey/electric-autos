<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Models\Makes;
use CoderStudios\Models\Models;
use CoderStudios\Library\Resource;

class ApiController extends BaseController
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache, Resource $resource, Makes $makes, Models $models)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->resource = $resource;
		$this->makes = $makes;
		$this->models = $models;
	}

	public function makesModels($make_id)
	{
		$key = $this->getKeyName(__function__ . '|' . $make_id);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$models = $this->models->where('make_id',$make_id)->get()->toArray();
			$view = json_encode($models);
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return response()->json(json_decode($view));
	}
}