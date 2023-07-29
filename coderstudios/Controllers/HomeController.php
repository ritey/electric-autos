<?php

namespace CoderStudios\Controllers;

use CoderStudios\Events\ContactSent;
use CoderStudios\Library\Resource;
use CoderStudios\Library\VehicleDetails;
use CoderStudios\Requests\ContactRequest;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Laravel Request Repository.
     *
     * @var object
     */
    protected $request;

    /**
     * Laravel Cache Repository.
     *
     * @var object
     */
    protected $cache;

    /**
     * Create a new home controller instance.
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
        // dd($this->resource->get(1));
        // $this->vehicle->scrape();
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $cars = [];
            $latest_key = $this->getKeyName(__FUNCTION__.'|cars');
            if ($this->cache->has($latest_key)) {
                $cars = $this->cache->get($latest_key);
            } else {
                $latest = $this->resource->latest()->get();
                foreach ($latest as $car) {
                    $cars[] = $this->vehicle->buildCar($car);
                }
                $this->cache->add($latest_key, $cars, config('coderstudios.cache_minutes'));
            }
            $vars = [
                'total_cars' => $this->resource->totalResources(),
                'latest' => $cars,
            ];
            $view = view('pages.home', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function about()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.about', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function cookie()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.cookie', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function contact()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.contact', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
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

        $key = $this->getKeyName(__FUNCTION__);

        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'page_title' => 'Electric Autos',
                'request' => $this->request,
            ];
            $view = view('pages.contact-sent', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function terms()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.terms', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function privacy()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.privacy', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function start()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key) && empty($this->request->session()->get('error_message'))) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.start', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function faqs()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [];
            $view = view('pages.faqs', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }
}
