<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Tweets as TweetModel;

class Tweets {

	protected $tweets;

	public function __construct(TweetModel $model)
	{
		$this->tweets = $model;
	}

	public function all()
	{
		return $this->tweets->all();
	}

	public function findByName($name)
	{
		return $this->tweets->where('name',$name)->get();
	}

	public function findById($id)
	{
		return $this->tweets->where('id',$name)->get();
	}

	public function findNext($date1, $date2)
	{
		return $this->tweets->whereBetween('next_at',[$date1,$date2])->get();
	}

	public function add(array $data)
	{
		return $this->tweets->create($data);
	}

	public function update($id, array $data)
	{
		return $this->tweets->where('id',$id)->update($data);
	}

}