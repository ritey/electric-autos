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
		$cars = $this->resource->filter($this->request)->paginate(env('APP_PER_PAGE',15));
		$half = number_format(ceil($cars->count() / 2));
		if ($half < 6) {
			$half = 6;
		}
		$chunks = $cars->chunk($half);

		$models = '';
		$brand = '';

		if ($this->request->input('make')) {

			if ($this->request->input('make') && $this->request->input('model')) {

				$params = [
					'brand' => $this->makes->where('id',$this->request->input('make'))->value('name'),
					'model' => $this->models->where('id',$this->request->input('model'))->value('name'),
				];

				return redirect()->route('cars.search.index', $params);
			}
			$models = $this->models->where('make_id',$this->request->input('make'))->orderBy('name','ASC')->get();
			$brand = $this->makes->where('id',$this->request->input('make'))->first();
		}

		$vars = [
			'request'				=> $this->request,
			'cars_collection'		=> $cars,
			'cars'					=> $chunks,
			'total_cars'			=> $this->resource->totalEnabled(),
			'total_cars_found'		=> $cars->total(),
			'total_page_total'		=> $cars->count(),
			'page'					=> $cars->currentPage(),
			'brand'					=> $brand,
			'makes'					=> $this->makes->orderBy('name','ASC')->get(),
			'models'				=> $models,
			'search_route'			=> route('cars.index'),
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

			if ($this->request->input('make')) {

				if ($this->request->input('make') && $this->request->input('model')) {

					$params = $this->request->all();
					$params['brand'] = $this->makes->where('id',$this->request->input('make'))->value('name');
					$params['model'] = $this->models->where('id',$this->request->input('model'))->value('name');
					unset($params['make']);
					unset($params['model']);

					return redirect()->route('cars.search.index', $params);
				} else {

					$params = $this->request->all();
					$params['brand'] = $this->makes->where('id',$this->request->input('make'))->value('name');
					unset($params['make']);

					return redirect()->route('cars.search.index', $params);
				}
				$models = $this->models->where('make_id',$this->request->input('make'))->orderBy('name','ASC')->get();
				$brand = $this->makes->where('id',$this->request->input('make'))->first();
			}

			$search_route = route('cars.brand.index', ['brand' => $brand->name]);
			//if (is_object($model)) {
			//	$search_route = route('cars.brand.index', ['brand' => $brand->name, 'model' => $model->name]);
			//}

			$cars = $this->resource->branded($brand->id,12)->paginate(env('APP_PER_PAGE',15));
			$half = number_format(ceil($cars->count() / 2));
			if ($half < 6) {
				$half = 6;
			}
			$chunks = $cars->chunk($half);

			$vars = [
				'request'				=> $this->request,
				'cars_collection'		=> $cars,
				'cars'					=> $chunks,
				'total_cars'			=> $this->resource->totalEnabled(),
				'total_cars_found'		=> $cars->total(),
				'total_page_total'		=> $cars->count(),
				'page'					=> $cars->currentPage(),
				'brand'					=> $brand,
				'models'				=> $this->models->where('make_id',$brand->id)->orderBy('name','ASC')->get(),
				'makes'					=> $this->makes->orderBy('name','ASC')->get(),
				'search_route'			=> $search_route,

			];
			$view = view('pages.cars-index',compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function model($brand, $model = '')
	{

		if ($this->request->input('make') && $this->request->input('model')) {

			$params = $this->request->all();
			$params['brand'] = $this->makes->where('id',$this->request->input('make'))->value('name');
			$params['version'] = $this->models->where('id',$this->request->input('model'))->value('name');

			unset($params['make']);
			unset($params['model']);

			return redirect()->route('cars.search.index', $params);
		} elseif ($this->request->input('make')) {

			$params = $this->request->all();
			$params['brand'] = $this->makes->where('id',$this->request->input('make'))->value('name');
			unset($params['make']);
			unset($params['model']);
			return redirect()->route('cars.brand.index', $params);

		}

		$key = $this->getKeyName(__function__ . '|' . $brand . '|' . $model);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {

			$brand = $this->makes->whereRaw('LOWER(name) = ?',[strtolower($brand)])->first();

			if ($model != '') {
				$model = $this->models->whereRaw('LOWER(name) = ?',[strtolower($model)])->first();
			}

			if (!$brand) {
				Abort(404);
			}

			$search_route = route('cars.brand.index', ['brand' => $brand->name]);
			if (is_object($model)) {
				$search_route = route('cars.search.index', ['brand' => $brand->name, 'version' => $model->name]);
			}

			$cars = $this->resource->branded($brand->id,12)->paginate(env('APP_PER_PAGE',15));
			$half = number_format(ceil($cars->count() / 2));
			if ($half < 6) {
				$half = 6;
			}
			$chunks = $cars->chunk($half);

			$vars = [
				'request'				=> $this->request,
				'cars_collection'		=> $cars,
				'cars'					=> $chunks,
				'total_cars'			=> $this->resource->totalEnabled(),
				'total_cars_found'		=> $cars->total(),
				'total_page_total'		=> $cars->count(),
				'page'					=> $cars->currentPage(),
				'brand'					=> $brand,
				'models'				=> $this->models->where('make_id',$brand->id)->orderBy('name','ASC')->get(),
				'model'					=> $model,
				'makes'					=> $this->makes->orderBy('name','ASC')->get(),
				'search_route'			=> $search_route,

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