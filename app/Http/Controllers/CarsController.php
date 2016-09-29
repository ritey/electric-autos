<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Library\Makes;
use CoderStudios\Library\Models;
use CoderStudios\Library\Resource;
use Session;

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
		$models = '';
		$brand = '';
		Session::put('back_url', $this->request->fullUrl());

		if ($this->request->input('make')) {

			if ($this->request->input('make') && $this->request->input('model')) {
				$brand = $this->makes->getById($this->request->input('make'));
				$model = $this->models->get($this->request->input('model'));

				return redirect()->route('cars.search.index', [
					'brand' => strtolower($brand->name),
					'model' => strtolower($model->name),
				]);
			}
			$models = $this->models->getByMakeId($this->request->input('make'));
			$brand = $this->makes->getById($this->request->input('make'));
		}

		$cars = $this->resource->filter($this->request)->with('make','model','images','dealer')->paginate(env('APP_PER_PAGE',15));
		$half = number_format(ceil($cars->count() / 2));
		if ($half < 6) {
			$half = 6;
		}
		$chunks = $cars->chunk($half);
		$makes = $this->makes->all();

		$vars = [
			'request'				=> $this->request,
			'cars_collection'		=> $cars,
			'cars'					=> $chunks,
			'total_cars'			=> $this->resource->totalEnabled(),
			'total_cars_found'		=> $cars->total(),
			'total_page_total'		=> $cars->count(),
			'page'					=> $cars->currentPage(),
			'brand'					=> $brand,
			'makes'					=> $makes->sortBy('name'),
			'models'				=> $models,
			'search_route'			=> route('cars.index'),
			'page_title'			=> 'Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars',
		];
		return view('pages.cars-index',compact('vars'));
	}

	public function brand($brand)
	{
		$key = $this->getKeyName(__function__ . '|' . $brand);
		$page_title = 'Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars';
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {

			$brand = $this->makes->getByName($brand);

			if (!$brand) {
				Abort(404);
			}

			if ($this->request->input('make')) {
				$params = $this->request->all();

				if ($this->request->input('make') && $this->request->input('model')) {
					$brand = $this->makes->getById($this->request->input('make'));
					$model = $this->models->getById($this->request->input('model'));
					$params['brand'] = strtolower($brand->name);
					$params['version'] = strtolower(str_replace(' ','+',$model->name));
					unset($params['make']);
					unset($params['model']);
					return redirect()->route('cars.search.index', $params);
				} else {
					$brand = $this->makes->getById($this->request->input('make'));
					$params['brand'] = $brand->name;
					unset($params['make']);
					return redirect()->route('cars.search.index', $params);
				}
				$models = $this->models->getByMakeId($this->request->input('make'));
				$brand = $this->makes->getById($this->request->input('make'));
			}

			$search_route = route('cars.brand.index', ['brand' => $brand->name]);

			$page_title = $brand->name . '\'s for sale on Electric Autos. Find used ' . $brand->name . ' cars for sale in our classifieds.';

			$cars = $this->resource->branded($brand->id,env('APP_PER_PAGE',15))->with('make','model','images','dealer')->paginate(env('APP_PER_PAGE',15));
			$half = number_format(ceil($cars->count() / 2));
			if ($half < 6) {
				$half = 6;
			}
			$chunks = $cars->chunk($half);

			Session::put('back_url', $this->request->fullUrl());
			$makes = $this->makes->all();
			$models = $this->models->getByMakeId($brand->id);

			$vars = [
				'request'				=> $this->request,
				'cars_collection'		=> $cars,
				'cars'					=> $chunks,
				'total_cars'			=> $this->resource->totalEnabled(),
				'total_cars_found'		=> $cars->total(),
				'total_page_total'		=> $cars->count(),
				'page'					=> $cars->currentPage(),
				'brand'					=> $brand,
				'models'				=> $models->sortBy('name'),
				'makes'					=> $makes->sortBy('name'),
				'search_route'			=> $search_route,
				'page_title'			=> $page_title,
			];
			$view = view('pages.cars-index',compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function model($brand, $model = '')
	{
		$page_title = 'Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars';
		$params = $this->request->all();
		if ($this->request->input('make') && $this->request->input('model')) {
			$brand = $this->makes->getById($this->request->input('make'));
			$model = $this->models->getById($this->request->input('model'));
			$params['brand'] = strtolower($brand->name);
			$params['version'] = strtolower(str_replace(' ','+',$model->name));
			unset($params['make']);
			unset($params['model']);
			return redirect()->route('cars.search.index', $params);
		} elseif ($this->request->input('make')) {
			$brand = $this->makes->getById($this->request->input('make'));
			$params['brand'] = $brand->name;
			unset($params['make']);
			unset($params['model']);
			return redirect()->route('cars.brand.index', $params);
		}

		$key = $this->getKeyName(__function__ . '|' . $brand . '|' . $model);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {

			$brand = $this->makes->getByName($brand);

			if ($model != '') {
				$model = $this->models->getByName(str_replace('+',' ',$model));
				$this->request->request->add(['model' => $model->id]);
			}

			if (!$brand) {
				Abort(404);
			}

			$page_title = $brand->name . ' for sale on Electric Autos. Find used ' . $brand->name . ' cars for sale in our classifieds.';

			$search_route = route('cars.brand.index', ['brand' => $brand->name]);
			if (is_object($model)) {
				$search_route = route('cars.search.index', ['brand' => $brand->name, 'version' => $model->name]);
				$page_title = $brand->name . ' ' . $model->name . ' for sale on Electric Autos. Find used ' . $brand->name . ' ' . $model->name . ' cars for sale in our classifieds.';
			}

			$this->request->request->add(['make' => $brand->id]);
			$makes = $this->makes->all();
			$models = $this->models->getByMakeId($brand->id);

			$cars = $this->resource->filter($this->request)->with('make','model','images','dealer')->paginate(env('APP_PER_PAGE',15));
			$half = number_format(ceil($cars->count() / 2));
			if ($half < 6) {
				$half = 6;
			}
			$chunks = $cars->chunk($half);

			Session::put('back_url', $this->request->fullUrl());

			$vars = [
				'request'				=> $this->request,
				'cars_collection'		=> $cars,
				'cars'					=> $chunks,
				'total_cars'			=> $this->resource->totalEnabled(),
				'total_cars_found'		=> $cars->total(),
				'total_page_total'		=> $cars->count(),
				'page'					=> $cars->currentPage(),
				'brand'					=> $brand,
				'models'				=> $models->sortBy('name'),
				'model'					=> $model,
				'makes'					=> $makes->sortBy('name'),
				'search_route'			=> $search_route,
				'page_title'			=> $page_title,
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
			$brand = $this->makes->getByName($brand);
			$car = $this->resource->whereSlug($slug);
			$makes = $this->makes->all();
			$models = $this->models->getByMakeId($brand->id);

			if (!$brand || !$car) {
				Abort(404);
			}

			$vars = [
				'makes'		=> $makes->sortBy('name'),
				'models'	=> $models->sortBy('name'),
				'brand'		=> $brand,
				'car'		=> $car,
				'back_url'	=> Session::get('back_url'),
			];
			$view = view('pages.cars-post',compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}
}