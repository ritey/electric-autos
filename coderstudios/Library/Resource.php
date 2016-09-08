<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Resources;
use CoderStudios\Library\Dealer;

class Resource {

	public function __construct(Resources $model, Dealer $dealer)
	{
		$this->resource = $model;
		$this->dealer = $dealer;
	}

	public function create(array $data)
	{
		return $this->resource->create($data);
	}

	public function update($id, array $data)
	{
		return $this->resource->where('id',$id)->first()->update($data);
	}

	public function get($id) {
		$resource = $this->resource->where('id',$id)->first();

		return $resource;
	}

	public function totalEnabled()
	{
		return $this->resource->enabled()->count();
	}

	public function filter($request)
	{
		$result = $this->resource->enabled();
		if ($request->input('make')) {
			$result = $result->where('make_id',$request->input('make'));
		}
		if ($request->input('model')) {
			$result = $result->where('model_id',$request->input('model'));
		}
		if ($request->input('min_price')) {
			$result = $result->where('price','>=',$request->input('min_price'));
		}
		if ($request->input('max_price')) {
			$result = $result->where('price','<=',$request->input('max_price'));
		}
		if ($request->input('max_price')) {
			$result = $result->where('price','<=',$request->input('max_price'));
		}
		if ($request->input('min_mileage')) {
			$result = $result->where('mileage','<=',$request->input('min_mileage'));
		}
		if ($request->input('max_mileage')) {
			$result = $result->where('mileage','<=',$request->input('max_mileage'));
		}
		if ($request->input('min_year')) {
			$result = $result->where('year','<=',$request->input('min_year'));
		}
		if ($request->input('max_year')) {
			$result = $result->where('year','<=',$request->input('max_year'));
		}
		return $result;
	}

	public function latest($amount = 3)
	{
		return $this->resource->enabled()->orderBy('created_at','DESC')->take($amount);
	}

	public function branded($brand_id, $amount = 3)
	{
		return $this->resource->enabled()->where('make_id',$brand_id)->orderBy('created_at','DESC')->take($amount);
	}

	public function modeled($brand_id, $model_id, $amount = 3)
	{
		return $this->resource->enabled()->where('make_id',$brand_id)->where('model_id',$model_id)->orderBy('created_at','DESC')->take($amount);
	}

	public function whereSlug($slug = '')
	{
		return $this->resource->enabled()->where('slug',$slug)->first();
	}

	public function mine($user_id)
	{
		return $this->resource->where('user_id',$user_id)->orderBy('created_at','DESC')->paginate();
	}

	public function myAd($user_id, $slug = '')
	{
		return $this->resource->where('user_id',$user_id)->where('slug',$slug)->first();
	}

	public function truncate()
	{
		return $this->resource->truncate();
	}

	public function totalResources()
	{
		return $this->resource->enabled()->count();
	}

	public function all()
	{
		return $this->resource->enabled()->get();
	}

	public function paginate($perPage = 15)
	{
		return $this->resource->paginate($perPage);
	}
}