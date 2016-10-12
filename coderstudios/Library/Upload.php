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
		return $this->upload->get();
	}

	public function mine($id)
	{
		return $this->upload->where('user_id',$id);
	}

	public function article($article)
	{
		if ($article) {
			return $this->upload->where('article_id',$article);
		} else {
			return $this->upload->where('folder','site');
		}
	}

	public function truncate()
	{
		return $this->upload->truncate();
	}

}