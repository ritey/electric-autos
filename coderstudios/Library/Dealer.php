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

	public function create(array $data)
	{
		return $this->dealer->create($data);
	}

}