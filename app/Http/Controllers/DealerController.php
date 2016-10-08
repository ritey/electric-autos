<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Library\Dealer;
use CoderStudios\Models\Makes;
use CoderStudios\Models\Models;
use CoderStudios\Library\Resource;
use Session;

class DealerController extends BaseController
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
	public function __construct(Request $request, Cache $cache, Dealer $dealer, Resource $resource, Makes $makes, Models $models)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->dealer = $dealer;
		$this->resource = $resource;
		$this->makes = $makes;
		$this->models = $models;
	}

	public function dealer($slug)
	{
		$key = $this->getKeyName(__function__ . '|' . strtolower($slug));
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {

			$dealer = $this->dealer->whereSlug($slug);
			$this->request->request->add(['dealer_id' => $dealer->id]);

			$cars = $this->resource->filter($this->request)->paginate(env('APP_PER_PAGE',15));
			$half = number_format(ceil($cars->count() / 2));
			if ($half < 6) {
				$half = 6;
			}
			$chunks = $cars->chunk($half);

			$brand = '';
			$makes = $this->makes->get();
			$models = $this->models->where('make_id',1)->get();

			Session::put('back_url', $this->request->fullUrl());

			$vars = [
				'dealer'				=> $dealer,
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
			$view = view('pages.dealer', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}
}