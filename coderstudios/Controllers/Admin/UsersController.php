<?php

namespace CoderStudios\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use CoderStudios\Models\Users;
use CoderStudios\Requests\UserRequest;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;

class UsersController extends BaseController
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
    public function __construct(Request $request, Cache $cache, Users $users)
    {
        parent::__construct($cache);
        $this->namespace = __NAMESPACE__;
        $this->basename = class_basename($this);
        $this->request = $request;
        $this->cache = $cache;
        $this->users = $users;
    }

    public function index()
    {
        $key = $this->getKeyName(__FUNCTION__);
        if ($this->cache->has($key)) {
            $view = $this->cache->get($key);
        } else {
            $vars = [
                'users' => $this->users->orderBy('id', 'desc')->paginate(),
            ];
            $view = view('admin.pages.users-index', compact('vars'))->render();
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
                'user' => $this->users->where('id', $id)->first(),
            ];
            $view = view('admin.pages.users-edit', compact('vars'))->render();
            $this->cache->add($key, $view, config('coderstudios.cache_minutes'));
        }

        return $view;
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->only('name', 'email');
        $user = $this->users->where('id', $id)->first();
        $user->update($data);

        return redirect()->route('admin.users')->with('success_message', 'User updated');
    }
}
