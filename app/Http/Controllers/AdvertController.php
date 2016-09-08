<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Requests\AdRequest;
use CoderStudios\Requests\VehicleRequest;
use CoderStudios\Library\VehicleDetails;
use CoderStudios\Library\Resource;
use CoderStudios\Models\Makes;
use CoderStudios\Models\Models;
use Session;
use Auth;

class AdvertController extends BaseController
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
	public function __construct(Request $request, Cache $cache,VehicleDetails $vehicle, Resource $resource, Makes $makes, Models $models)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->vehicle = $vehicle;
		$this->resource = $resource;
		$this->makes = $makes;
		$this->models = $models;
		$this->middleware('auth',['except' => ['details','saveVehicle']]);
	}

	public function details(AdRequest $request)
	{
		$vehicle = [];
		if ($request->input('reg')) {
			$vehicle = $this->vehicle->fetch($request->input('reg'));
		}

		$vehicle['mileage'] = $request->input('mileage');

		Session::put('vehicle',$vehicle);

		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'vehicle' => $vehicle,
				'models'	=> $this->models->where('make_id',$vehicle['make_id'])->orderBy('name','ASC')->get(),
				'makes' => $this->makes->orderBy('name','ASC')->get(),
			];
			$view = view('pages.advert-details', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function saveVehicle(VehicleRequest $request)
	{

		$vehicle = Session::get('vehicle');

		$resource = [
			/*'enabled',
	        'sold',
	        'car_type_id',*/
	        'enabled' 	=> 0,
	        'sort_order' => 1,
	        'private' 	=> 1,
	        'user_id' 	=> 0,
	        'dealer_id' => 0,
	        'make_id'	=> $request->input('make_id'),
	        'model_id'	=> $request->input('model_id'),
	        'name'		=> $request->input('name'),
	        'price'		=> $request->input('price'),
	        'fuel'		=> 'Electric',
	        'year'		=> trim($vehicle['year']),
	        'colour'	=> $vehicle['colour'],
	        'reg'		=> $vehicle['reg'],
	        'gearbox'	=> $request->input('gearbox'),
	        'doors'		=> $request->input('doors'),
	        'slug'		=> $this->vehicle->makeSlug($request->input('name')),
	        'mileage'	=> $vehicle['mileage'],
	        'currency'	=> $request->input('currency'),
	        'content'	=> $request->input('content'),
		];

		$result = $this->resource->create($resource);

		if ($result) {
			$data = [
				'slug' => $resource['slug'] . '-' . $result->id,
			];

			$this->resource->update($result->id, $data);

			Session::put('vehicle_id',$result->id);
			return redirect()->route('register');
		}

	}

	public function create()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'vehicle' => $vehicle,
			];
			$view = view('pages.advert-details', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;

	}

	public function edit($slug)
	{
		$vehicle = $this->resource->myAd(Auth::User()->id,$slug);

		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'models'	=> $this->models->where('make_id',$vehicle['make_id'])->orderBy('name','ASC')->get(),
				'makes' => $this->makes->orderBy('name','ASC')->get(),
				'vehicle' => $vehicle,
			];
			$view = view('pages.ad.edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;

	}

	public function save()
	{

	}
}