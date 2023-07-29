<?php

namespace CoderStudios\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use CoderStudios\Models\Resources;
use CoderStudios\Requests\AdRequest;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;

class AdsController extends BaseController
{
    /**
     * Laravel Request Repository.
     *
     * @var object
     */
    protected $request;

    /**
     * Laravel Cache Repository.
     *
     * @var object
     */
    protected $cache;

    /**
     * Create a new home controller instance.
     */
    public function __construct(Request $request, Cache $cache, Resources $resource)
    {
        parent::__construct($cache);
        $this->namespace = __NAMESPACE__;
        $this->basename = class_basename($this);
        $this->request = $request;
        $this->cache = $cache;
        $this->resource = $resource;
    }

    public function index()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'ads' => $this->resource->orderBy('id', 'desc')->paginate(),
            ];
            $view = view('admin.pages.ads-index', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function edit($id)
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'ad' => $this->resource->where('id', $id)->first(),
            ];
            $view = view('admin.pages.ads-edit', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function update(AdRequest $request, $id)
    {
        $data = $request->only();
        $ad = $this->resource->where('id', $id)->first();
        $ad->update($data);
        $this->clearAdminCache();

        return redirect()->route('admin.ads')->with('success_message', 'Ad updated');
    }
}
