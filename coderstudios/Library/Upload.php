<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Uploads;

class Upload {

	public function __construct(Uploads $model)
	{
		$this->upload = $model;
	}

	public function create(array $data)
	{
		return $this->upload->create($data);
	}

	public function all()
	{
		return $this->upload->all();
	}

	public function truncate()
	{
		return $this->upload->truncate();
	}

}