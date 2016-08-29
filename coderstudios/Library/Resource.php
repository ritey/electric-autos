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

	public function get($id) {
		$resource = $this->resource->where('id',$id)->first();

		return $resource;
	}

	public function latest($amount = 3)
	{
		return $this->resource->enabled()->orderBy('created_at','DESC')->take($amount);
	}

	public function branded($brand_id, $amount = 3)
	{
		return $this->resource->enabled()->where('make_id',$brand_id)->orderBy('created_at','DESC')->take($amount);
	}

	public function whereSlug($slug = '')
	{
		return $this->resource->enabled()->where('slug',$slug)->first();
	}
}