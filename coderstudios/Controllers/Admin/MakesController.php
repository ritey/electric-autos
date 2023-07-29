<?php

namespace CoderStudios\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use CoderStudios\Models\Makes;
use CoderStudios\Requests\MakesRequest;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;

class MakesController extends BaseController
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
    public function __construct(Request $request, Cache $cache, Makes $makes)
    {
        parent::__construct($cache);
        $this->namespace = __NAMESPACE__;
        $this->basename = class_basename($this);
        $this->request = $request;
        $this->cache = $cache;
        $this->makes = $makes;
    }

    public function index()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'makes' => $this->makes->orderBy('name', 'asc')->paginate(),
            ];
            $view = view('admin.pages.makes-index', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function create()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'make' => $this->makes->newInstance(),
            ];
            $view = view('admin.pages.makes-create', compact('vars'))->render();
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
                'make' => $this->makes->where('id', $id)->first(),
            ];
            $view = view('admin.pages.makes-edit', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function update(MakesRequest $request, $id)
    {
        $data = $request->only('name');
        $ad = $this->makes->where('id', $id)->first();
        $ad->update($data);
        foreach (['edit', 'create', 'index'] as $name) {
            $this->cache->forget($this->getKeyName($name));
        }

        return redirect()->route('admin.makes')->with('success_message', 'Make updated');
    }

    public function store(MakesRequest $request)
    {
        $data = $request->only('name');
        $this->makes->create($data);
        foreach (['edit', 'create', 'index'] as $name) {
            $this->cache->forget($this->getKeyName($name));
        }

        return redirect()->route('admin.makes')->with('success_message', 'Make created');
    }
}
