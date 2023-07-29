<?php

namespace CoderStudios\Library;

use CoderStudios\LaravelBootstrap\Traits\Key;
use CoderStudios\Models\Resources;
use Illuminate\Contracts\Cache\Repository as Cache;

class Resource
{
    use Key;

    public function __construct(Resources $model, Dealer $dealer, Cache $cache)
    {
        $this->resource = $model;
        $this->dealer = $dealer;
        $this->cache = $cache;
    }

    public function create(array $data)
    {
        return $this->resource->create($data);
    }

    public function update($id, array $data)
    {
        return $this->resource->where('id', $id)->first()->update($data);
    }

    public function get($id)
    {
        return $this->resource->where('id', $id)->first();
    }

    public function totalEnabled()
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->resource->enabled()->count();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }

    public function filter($request)
    {
        // $key = md5(snake_case(str_replace('\\','',__NAMESPACE__) . class_basename($this) . '_' . __function__ . '_' . implode('|', $request->all())));
        // if ($this->cache->has($key)) {
        //	$result = $this->cache->get($key);
        // } else {
        $result = $this->resource->enabled();
        if ($request->input('dealer_id')) {
            $result = $result->where('dealer_id', $request->input('dealer_id'));
        }
        if ($request->input('make')) {
            $result = $result->where('make_id', $request->input('make'));
        }
        if ($request->input('model')) {
            $result = $result->where('model_id', $request->input('model'));
        }
        if ($request->input('min_price')) {
            $result = $result->where('price', '>=', $request->input('min_price'));
        }
        if ($request->input('max_price')) {
            $result = $result->where('price', '<=', $request->input('max_price'));
        }
        if ($request->input('min_mileage')) {
            $result = $result->where('mileage', '>=', $request->input('min_mileage'));
        }
        if ($request->input('max_mileage')) {
            $result = $result->where('mileage', '<=', $request->input('max_mileage'));
        }
        if ($request->input('min_year')) {
            $result = $result->where('year', '>=', $request->input('min_year'));
        }
        if ($request->input('max_year')) {
            $result = $result->where('year', '<=', $request->input('max_year'));
        }
        // $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        // }
        // dd($result);
        return $result->with('make', 'model', 'images', 'dealer')->withCount('images');
    }

    public function latest($amount = 3)
    {
        return $this->resource->enabled()->with('make', 'model', 'images', 'dealer')->withCount('images')->orderBy('created_at', 'DESC')->take($amount);
    }

    public function branded($brand_id, $amount = 3)
    {
        return $this->resource->enabled()->where('make_id', $brand_id)->orderBy('created_at', 'DESC')->take($amount);
    }

    public function modeled($brand_id, $model_id, $amount = 3)
    {
        return $this->resource->enabled()->where('make_id', $brand_id)->where('model_id', $model_id)->orderBy('created_at', 'DESC')->take($amount);
    }

    public function whereSlug($slug = '')
    {
        return $this->resource->enabled()->where('slug', $slug)->withCount('images')->first();
    }

    public function mine($user_id)
    {
        return $this->resource->where('user_id', $user_id)->orderBy('created_at', 'DESC');
    }

    public function myAd($user_id, $slug = '')
    {
        return $this->resource->where('user_id', $user_id)->where('slug', $slug)->first();
    }

    public function truncate()
    {
        return $this->resource->truncate();
    }

    public function totalResources()
    {
        $key = $this->key(str_replace('\\', '', __NAMESPACE__).class_basename($this).'_'.__FUNCTION__);
        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $result = $this->resource->enabled()->count();
            $this->cache->add($key, $result, config('coderstudios.cache_minutes'));
        }

        return $result;
    }

    public function all()
    {
        return $this->resource->enabled()->with('make', 'model', 'images', 'dealer')->get();
    }

    public function paginate($perPage = 15)
    {
        return $this->resource->with('make', 'model', 'images', 'dealer')->paginate($perPage);
    }
}
