<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Requests\AdRequest;
use CoderStudios\Requests\VehicleRequest;
use CoderStudios\Library\VehicleDetails;
use CoderStudios\Library\Resource;
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
	public function __construct(Request $request, Cache $cache,VehicleDetails $vehicle, Resource $resource)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->vehicle = $vehicle;
		$this->resource = $resource;
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
	        'make_id'	=> $vehicle['make_id'],
	        'model_id'	=> $vehicle['model_id'],
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