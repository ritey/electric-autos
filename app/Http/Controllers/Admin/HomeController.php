<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Http\Controllers\Admin\BaseController;
use Cache as CacheFacade;

class HomeController extends BaseController
{

    /**
     * Laravel Request Repository
     *
     * @var object
     */
    protected $request;

    /**
     * Laravel Cache Repository
     *
     * @var object
     */
    protected $cache;

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
	}

	public function home()
	{
		$vars = [];
		return view('admin.pages.home', compact('vars'))->render();
	}

	public function clear()
	{
		CacheFacade::flush();
		return redirect()->route('admin.home')->with('success_message','All cache cleared');
	}

	public function log()
	{
		$vars = [
			'log' => file_get_contents(storage_path().'/logs/laravel.log'),
		];
		return view('admin.pages.log', compact('vars'))->render();
	}

	public function clearLog()
	{
		$filename = storage_path().'/logs/laravel.log';
		$handle = fopen($filename, 'r+');
		ftruncate($handle, 0);
		fclose($handle);
		return redirect()->route('admin.home')->with('success_message','Log file cleared');
	}
}