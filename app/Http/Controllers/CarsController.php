<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Models\Makes;
use CoderStudios\Library\Resource;

class CarsController extends BaseController
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache, Resource $resource, Makes $makes)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->resource = $resource;
		$this->makes = $makes;
	}

	public function index()
	{
		$vars = [
			'cars' => $this->resource->latest(12)->get(),
		];
		return view('pages.cars-index',compact('vars'));
	}

	public function brand($brand)
	{
		$key = $this->getKeyName(__function__ . '|' . $brand);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {

			$brand = $this->makes->whereRaw('LOWER(name) = ?',[strtolower($brand)])->first();

			if (!$brand) {
				Abort(404);
			}

			$vars = [
				'brand' => $brand,
				'cars' => $this->resource->branded($brand->id,12)->get(),
			];
			$view = view('pages.cars-index',compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function post($brand = '', $slug)
	{
		$key = $this->getKeyName(__function__ . '|' . $brand . '|' . $slug);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {

			$brand = $this->makes->whereRaw('LOWER(name) = ?',[strtolower($brand)])->first();
			$car = $this->resource->whereSlug($slug);

			if (!$brand || !$car) {
				Abort(404);
			}

			$vars = [
				'brand' => $brand,
				'car' => $car,
				'back_url' => '',
			];
			$view = view('pages.cars-post',compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}
}