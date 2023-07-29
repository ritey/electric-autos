<?php

namespace CoderStudios\Library;

use CoderStudios\LaravelBootstrap\Traits\Key;
use CoderStudios\Models\Models as ModelsModel;
use Illuminate\Contracts\Cache\Repository as Cache;

class Models
{
    use Key;

    public function __construct(ModelsModel $model, Cache $cache)
    {
        $this->models = $model;
        $this->cache = $cache;
    }

    public function all()
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->models->get();
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
            $result = $this->models->where('id', $id)->first();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }

    public function getByMakeId($make_id)
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__.'_'.$make_id);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->models->where('make_id', $make_id)->get();
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
            $result = $this->models->whereRaw('LOWER(name) = ?', [strtolower($name)])->first();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }
}
