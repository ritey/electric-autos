<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Library\VehicleDetails;
use CoderStudios\Library\Resource;
use CoderStudios\Requests\ContactRequest;
use App\Events\ContactSent;
use Session;

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
	public function __construct(Request $request, Cache $cache, VehicleDetails $vehicle, Resource $resource)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->vehicle = $vehicle;
		$this->resource = $resource;
	}

	public function home()
	{
		Session::put('back_url', $this->request->fullUrl());
		//dd($this->resource->get(1));
		//$this->vehicle->scrape();
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$cars = [];
			$latest_key = $this->getKeyName(__function__ . '|cars');
			if ($this->cache->has($latest_key)) {
				$cars = $this->cache->get($latest_key);
			} else {
				$latest = $this->resource->latest()->get();
				foreach($latest as $car) {
					$cars[] = $this->vehicle->buildCar($car);
				}
				$this->cache->add($latest_key, $cars, env('APP_CACHE_MINUTES'));
			}
			$vars = [
				'total_cars' 	=> $this->resource->totalResources(),
				'latest' 		=> $cars,
			];
			$view = view('pages.home', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function about()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'featured' => ['1',2,3],
				'latest' => ['1',2,3],
			];
			$view = view('pages.about', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function cookie()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				''
			];
			$view = view('pages.cookie', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function contact()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [

			];
			$view = view('pages.contact', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

    /**
     * Send a contact form message.
     *
     * @return \Illuminate\Http\Response
     */
	public function sendContact(ContactRequest $request)
	{

		event(new ContactSent($request));

		$key = $this->getKeyName(__function__);

		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'page_title'		=> 'Pitchy',
				'request'			=> $this->request,
			];
			$view = view('pages.contact-sent', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function terms()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'featured' => ['1',2,3],
				'latest' => ['1',2,3],
			];
			$view = view('pages.terms', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function privacy()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'featured' => ['1',2,3],
				'latest' => ['1',2,3],
			];
			$view = view('pages.privacy', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function start()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [];
			$view = view('pages.start', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function faqs()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'featured' => ['1',2,3],
				'latest' => ['1',2,3],
			];
			$view = view('pages.faqs', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

}