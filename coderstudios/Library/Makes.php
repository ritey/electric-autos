<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Makes as MakesModel;
use Illuminate\Contracts\Cache\Repository as Cache;

class Makes {

	public function __construct(MakesModel $model, Cache $cache)
	{
		$this->makes = $model;
		$this->cache = $cache;
	}

	public function all()
	{
		$key = md5(snake_case(str_replace('\\','',__NAMESPACE__) . class_basename($this) . '_' . __function__));
		if ($this->cache->has($key)) {
			$result = $this->cache->get($key);
		} else {
			$result = $this->makes->get();
			$this->cache->add($key, $result, env('APP_CACHE_MINUTES'));
		}
		return $result;
	}

	public function getById($id)
	{
		$key = md5(snake_case(str_replace('\\','',__NAMESPACE__) . class_basename($this) . '_' . __function__ . '_' . $id));
		if ($this->cache->has($key)) {
			$result = $this->cache->get($key);
		} else {
			$result = $this->makes->where('id',$id)->first();
			$this->cache->add($key, $result, env('APP_CACHE_MINUTES'));
		}
		return $result;
	}

	public function getByName($name)
	{
		$key = md5(snake_case(str_replace('\\','',__NAMESPACE__) . class_basename($this) . '_' . __function__ . '_' . $name));
		if ($this->cache->has($key)) {
			$result = $this->cache->get($key);
		} else {
			$result = $this->makes->whereRaw('LOWER(name) = ?',[strtolower($name)])->first();
			$this->cache->add($key, $result, env('APP_CACHE_MINUTES'));
		}
		return $result;
	}
}