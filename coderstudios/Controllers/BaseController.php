<?php

namespace CoderStudios\Controllers;

use App\Http\Controllers\Controller;
use CoderStudios\LaravelBootstrap\Traits\Key;
use Illuminate\Contracts\Cache\Repository as Cache;

class BaseController extends Controller
{
    use Key;
    protected $namespace = __NAMESPACE__;

    protected $basename;

    public function __construct(Cache $cache)
    {
        if ('local' == env('APP_ENV')) {
            $cache->flush();
        }
    }

    protected function getKeyName($string)
    {
        return $this->key(str_replace('\\', '', $this->namespace).$this->basename.'_'.$string);
    }
}
