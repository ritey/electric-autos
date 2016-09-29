<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Models as ModelsModel;
use Illuminate\Contracts\Cache\Repository as Cache;

class Models {

	public function __construct(ModelsModel $model, Cache $cache)
	{
		$this->models = $model;
		$this->cache = $cache;
	}

	public function all()
	{
		$key = md5(snake_case(str_replace('\\','',__NAMESPACE__) . class_basename($this) . '_' . __function__));
		if ($this->cache->has($key)) {
			$result = $this->cache->get($key);
		} else {
			$result = $this->models->get();
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
			$result = $this->models->where('id',$id)->first();
			$this->cache->add($key, $result, env('APP_CACHE_MINUTES'));
		}
		return $result;
	}

	public function getByMakeId($make_id)
	{
		$key = md5(snake_case(str_replace('\\','',__NAMESPACE__) . class_basename($this) . '_' . __function__ . '_' . $make_id));
		if ($this->cache->has($key)) {
			$result = $this->cache->get($key);
		} else {
			$result = $this->models->where('make_id',$make_id)->get();
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
			$result = $this->models->whereRaw('LOWER(name) = ?',[strtolower($name)])->first();
			$this->cache->add($key, $result, env('APP_CACHE_MINUTES'));
		}
		return $result;
	}
}