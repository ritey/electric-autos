<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Repository as Cache;

class BaseController extends Controller
{
	protected $namespace = __NAMESPACE__;

	protected $basename;

	public function __construct(Cache $cache) {
		$path = config('cache.stores.file.path');
		config(['cache.stores.file.path' => $path . '/admin']);
		if (env('APP_ENV') == 'local') {
			$cache->flush();
		}
		$this->cache = $cache;
	}

	protected function getKeyName($string) {
		return md5(snake_case(str_replace('\\','',$this->namespace) . $this->basename . '_' . $string));
	}

	protected function clearAdminCache() {
		$this->cache->flush();
	}
}