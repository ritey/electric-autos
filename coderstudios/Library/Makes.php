<?php

namespace CoderStudios\Library;

use CoderStudios\LaravelBootstrap\Traits\Key;
use CoderStudios\Models\Makes as MakesModel;
use Illuminate\Contracts\Cache\Repository as Cache;

class Makes
{
    use Key;

    public function __construct(MakesModel $model, Cache $cache)
    {
        $this->makes = $model;
        $this->cache = $cache;
    }

    public function all()
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->makes->get();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }

    public function getById($id)
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__.'_'.$id);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->makes->where('id', $id)->first();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }

    public function getByName($name)
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__.'_'.$name);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->makes->whereRaw('LOWER(name) = ?', [strtolower($name)])->first();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }
}
