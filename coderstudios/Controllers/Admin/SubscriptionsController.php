<?php

namespace CoderStudios\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;

class SubscriptionsController extends BaseController
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
    public function __construct(Request $request, Cache $cache)
    {
        parent::__construct($cache);
        $this->namespace = __NAMESPACE__;
        $this->basename = class_basename($this);
        $this->request = $request;
        $this->cache = $cache;
    }
}
