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
use App\Events\NewAd;
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

	private function car($request)
	{
		$vehicle = [];
		if ($request->input('reg')) {
			$vehicle = $this->vehicle->fetch($request->input('reg'));
		}

		$vehicle['mileage'] = $this->vehicle->makeMileage($request->input('mileage'));
		$vehicle['distance'] = $request->input('distance');

		Session::put('vehicle',$vehicle);
		return $vehicle;
	}

	public function details(AdRequest $request)
	{
		$vehicle = $this->car($request);
		$key = $this->getKeyName(__function__ . '|' . $request->input('reg'));
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'vehicle'	=> $vehicle,
				'models'	=> $this->models->where('make_id',$vehicle['make_id'])->orderBy('name','ASC')->get(),
				'makes'		=> $this->makes->orderBy('name','ASC')->get(),
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
	        'enabled' 			=> 0,
	        'sort_order' 		=> 1,
	        'private' 			=> 1,
	        'user_id' 			=> 0,
	        'dealer_id' 		=> 0,
	        'make_id'			=> $request->input('make_id'),
	        'model_id'			=> $request->input('model_id'),
	        'name'				=> trim($request->input('name')),
	        'price'				=> $this->vehicle->makePrice($request->input('price')),
	        'fuel'				=> $request->input('fuel'),
	        'year'				=> trim($vehicle['year']),
	        'colour'			=> trim($vehicle['colour']),
	        'reg'				=> $vehicle['reg'],
	        'gearbox'			=> $request->input('gearbox'),
	        'doors'				=> $request->input('doors'),
	        'slug'				=> $this->vehicle->makeSlug(trim($request->input('name'))),
	        'mileage'			=> $vehicle['mileage'],
	        'length_measure'	=> $vehicle['distance'],
	        'currency'			=> $request->input('currency'),
	        'content'			=> $request->input('content'),
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
		if (!Auth::user()->subscribed('Dealer Plan') && $this->resource->mine(Auth::user()->id)->get()->count() >= 2) {
			return redirect()->route('dashboard')->with('success_message','You must <a href="'.route('upgrade').'">upgrade</a> your account to create more ads');
		}

		$key = $this->getKeyName(__function__ . '|' . Auth::user()->user_id);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [];
			$view = view('pages.ad.create', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function createDetails(AdRequest $request)
	{
		$vehicle = $this->car($request);
		$key = $this->getKeyName(__function__ . '|' . $request->input('reg'));
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'vehicle'	=> $vehicle,
				'models'	=> $this->models->where('make_id',$vehicle['make_id'])->orderBy('name','ASC')->get(),
				'makes'		=> $this->makes->orderBy('name','ASC')->get(),
			];
			$view = view('pages.ad.details', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function saveNew(VehicleRequest $request)
	{
		$vehicle = Session::get('vehicle');

		$resource = [
	        'enabled' 			=> 1,
	        'sort_order' 		=> 1,
	        'private' 			=> empty(Auth::user()->dealer_id) ? 0 : 1,
	        'user_id' 			=> Auth::user()->id,
	        'dealer_id' 		=> Auth::user()->dealer_id,
	        'make_id'			=> $request->input('make_id'),
	        'model_id'			=> $request->input('model_id'),
	        'name'				=> trim($request->input('name')),
	        'price'				=> $this->vehicle->makePrice($request->input('price')),
	        'fuel'				=> $request->input('fuel'),
	        'year'				=> trim($vehicle['year']),
	        'colour'			=> trim($vehicle['colour']),
	        'reg'				=> $vehicle['reg'],
	        'gearbox'			=> $request->input('gearbox'),
	        'doors'				=> $request->input('doors'),
	        'slug'				=> $this->vehicle->makeSlug(trim($request->input('name'))),
	        'mileage'			=> $vehicle['mileage'],
	        'length_measure'	=> $vehicle['distance'],
	        'currency'			=> $request->input('currency'),
	        'content'			=> $request->input('content'),
		];

		$result = $this->resource->create($resource);

		if ($result) {
			$data = [
				'slug' => $resource['slug'] . '-' . $result->id,
			];

			$this->resource->update($result->id, $data);

			Session::forget('vehicle');

			$brand = $this->makes->where('id',$request['make_id'])->value('name');
			$version = $this->models->where('id',$request['model_id'])->value('name');

			$new_ad = [
				'tweet' => 'New electric car listed: ' . route('cars.brand.car', ['brand' => $brand, 'version' => $version, 'slug' => $data['slug']]) . '#ev #'.$brand.' #'.$version,
				'subject' => 'New ad: ' . route('cars.brand.car', ['brand' => $brand, 'version' => $version, 'slug' => $data['slug']]),
				'email_content' => 'New ad: ' . route('cars.brand.car', ['brand' => $brand, 'version' => $version, 'slug' => $data['slug']]),
			];

            event(new NewAd($new_ad));

			return redirect()->route('ad.edit', ['slug' => $data['slug']])->with('success_message','Ad created');
		}
		return redirect()->route('ad.create.details');
	}

	public function edit($slug = '')
	{
		$vehicle = $this->resource->myAd(Auth::User()->id,$slug);

		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'models'	=> $this->models->where('make_id',$vehicle['make_id'])->orderBy('name','ASC')->get(),
				'makes'		=> $this->makes->orderBy('name','ASC')->get(),
				'vehicle' 	=> $vehicle,
			];
			$view = view('pages.ad.edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function save(VehicleRequest $request, $slug)
	{
		$vehicle = $this->resource->myAd(Auth::User()->id,$slug);
		$resource = [
	        'enabled' 			=> $request->input('enabled') == 1 ? 1 : 0,
	        'make_id'			=> $request->input('make_id'),
	        'model_id'			=> $request->input('model_id'),
	        'name'				=> trim($request->input('name')),
	        'price'				=> $this->vehicle->makePrice($request->input('price')),
	        'fuel'				=> $request->input('fuel'),
	        'year'				=> trim($request->input('year')),
	        'colour'			=> trim($request->input('colour')),
	        'gearbox'			=> $request->input('gearbox'),
	        'doors'				=> $request->input('doors'),
	        'slug'				=> $this->vehicle->makeSlug(trim($request->input('name'))) . '-' . $vehicle->id,
	        'mileage'			=> $this->vehicle->makeMileage($request->input('mileage')),
	        'length_measure'	=> $request->input('distance'),
	        'currency'			=> $request->input('currency'),
	        'content'			=> $request->input('content'),
	        'sold'				=> $request->input('sold') == 1 ? 1 : 0,
		];

		$result = $this->resource->update($vehicle->id, $resource);
		return redirect()->route('ad.edit', ['slug' => $resource['slug']])->with('success_message','Details saved');
	}
}