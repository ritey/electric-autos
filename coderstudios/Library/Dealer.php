<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Dealers;

class Dealer {

	public function __construct(Dealers $model)
	{
		$this->dealer = $model;
	}

	public function dealerExists($name)
	{
		return $this->dealer->whereRaw('LOWER(name) = ?',[strtolower($name)])->first();
	}

	public function get($id) {
		return $this->dealer->where('id',$id)->first();
	}

	public function create(array $data)
	{
		return $this->dealer->create($data);
	}

	public function update($id, array $data)
	{
		return $this->dealer->where('id',$id)->first()->update($data);
	}

	public function whereSlug($slug = '')
	{
		return $this->dealer->where('slug',$slug)->first();
	}

	public function all()
	{
		return $this->dealer->enabled()->get();
	}

}