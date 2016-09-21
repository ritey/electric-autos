<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use Auth;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Upload;
use CoderStudios\Library\Dealer;
use CoderStudios\Requests\DealerRequest;
use CoderStudios\Traits\UUID;

class AccountController extends BaseController
{
	use UUID;

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
	public function __construct(Request $request, Cache $cache, Resource $resource, Upload $upload, Dealer $dealer)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->resource = $resource;
		$this->upload = $upload;
		$this->dealer = $dealer;
		$this->middleware('auth');
	}

	public function dashboard()
	{
		$key = $this->getKeyName(__function__ . '|' . Auth::user()->user_id);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'user' => Auth::user(),
				'ads' => $this->resource->mine(Auth::user()->id)->paginate(),
				'all_ads' => $this->resource->mine(Auth::user()->id)->get(),
				'all_pics' => $this->upload->mine(Auth::user()->id)->get(),
			];
			$view = view('pages.dashboard', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function dealer()
	{
		if (!Auth::user()->subscribed('Dealer Plan')) {
			return redirect()->route('dashboard');
		}

		$dealer = $this->dealer->get(Auth::user()->dealer_id);

		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'user' => Auth::user(),
				'dealer' => $dealer,
				'all_ads' => $this->resource->mine(Auth::user()->id)->get(),
				'all_pics' => $this->upload->mine(Auth::user()->id)->get(),
			];
			$view = view('pages.dealer.edit', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function saveDealer(DealerRequest $request)
	{
		$data = [
	        'name'			=> $request->input('name'),
	        'email'			=> $request->input('email'),
	        'phone'			=> $request->input('phone'),
	        'mobile'		=> $request->input('mobile'),
	        'location'		=> $request->input('location'),
	        'website'		=> $request->input('website'),
		];

		if (Auth::user()->dealer_id) {
			$result = $this->dealer->update(Auth::user()->dealer_id, $data);
		} else {
			$data['dealer_id'] = $this->Uuid(openssl_random_pseudo_bytes(16));
			$result = $this->dealer->create($data);
			$user = Auth::user();
			$user->dealer_id = $result->id;
			$user->save();
		}

		return redirect()->route('dealer.edit')->with('success_message','Details saved');
	}

	public function upgrade()
	{
		$key = $this->getKeyName(__function__);
		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'user' => Auth::user(),
				'ads' => $this->resource->mine(Auth::user()->id),
			];
			$view = view('pages.upgrade', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

	public function processUpgrade()
	{
		$user = Auth::user();
		$creditCardToken = $this->request->input('stripeToken');
		$result = $user->newSubscription('Dealer Plan','ea1')->create($creditCardToken, ['email' => $this->request->input('stripeEmail') ]);
		if ($result->stripe_plan) {
			return redirect()->route('dealer.edit')->with('success_message','Account upgraded!');
		}
	}
}