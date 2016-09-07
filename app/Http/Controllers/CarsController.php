<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Models\Makes;
use CoderStudios\Models\Models;
use CoderStudios\Library\Resource;

class CarsController extends BaseController
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

	public function index()
	{
		$cars = $this->resource->paginate();
		$half = number_format(ceil($cars->count() / 2));
		$chunks = $cars->chunk($half);

		$vars = [
			'cars_collection' 	=> $cars,
			'cars' 	=> $chunks,
			'total_cars' => $cars->count(),
			'brand' => '',
			'makes' => $this->makes->orderBy('name','ASC')->get(),
			'models'	=> '',
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

			$cars = $this->resource->branded($brand->id,12)->paginate();
			$half = number_format(ceil($cars->count() / 2));
			$chunks = $cars->chunk($half);

			$vars = [
				'cars_collection' 	=> $cars,
				'cars' => $chunks,
				'total_cars' => $cars->count(),
				'brand' => $brand,
				'models'	=> $this->models->where('make_id',$brand->id)->orderBy('name','ASC')->get(),
				'makes' => $this->makes->orderBy('name','ASC')->get(),
			];
			$view = view('pages.cars-index',compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function post($brand = '', $model = '', $slug)
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
				'makes' => $this->makes->orderBy('name','ASC')->get(),
				'models'	=> $this->models->where('make_id',$brand->id)->orderBy('name','ASC')->get(),
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