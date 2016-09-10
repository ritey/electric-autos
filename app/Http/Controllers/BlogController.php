<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Models\Articles;

class BlogController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Blog Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the index page and article pages for Pitchy site
    |
    |
    */

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
	public function __construct(Request $request, Cache $cache, Articles $articles)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->cache = $cache;
		$this->request = $request;
		$this->articles = $articles;
	}

    /**
     * Show the application blog index page.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$key = $this->getKeyName(__function__);

		$article = [
	        'enabled' => 1,
	        'sort_order' => 0,
	        'slug' => 'electric-autos-first-post',
	        'name' => 'Electric Autos',
	        'meta_author' => 'David Wright',
	        'meta_date' => '2016-07-01 09:30:00',
	        'meta_title' => 'Electric Autos is here!',
	        'meta_description' => 'Electric Autos is here!',
	        'summary' => 'Electric Autos is here!',
	        'body' => '<p>Electric Autos is here!</p>',
	        'updated_at' => '2016-07-01 20:10:00',
	        'live_at' => '2016-09-05 09:00:00',
		];

		//$first = $this->articles->create($article);

		$articles = $this->articles->where('enabled',1)->orderBy('sort_order','DESC')->orderBy('live_at','DESC')->take(10)->get();

		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'request'			=> $this->request,
				'articles'			=> $articles,
			];
			$view = view('pages.blog-index', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}

    /**
     * Show the application blog article page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
	public function article($slug = '')
	{
		$key = $this->getKeyName(__function__);

		$article = $this->articles->where('slug',strtolower(trim($slug)))->first();

		if ($article->images()->count()) {
			$article->image = '/image.png?width=1200&height=900&filename=' . $article->images->first()->maskname . '.' . $article->images->first()->extension . '&folder=' . $article->images->first()->folder;
		}

		if (!$article) {
			$article = $this->articles->where('id',strtolower(trim($slug)))->first();
		}

		if (!$article) {
			Abort(404);
		}

		if ($this->cache->has($key)) {
			$view = $this->cache->get($key);
		} else {
			$vars = [
				'page_title'		=> $article->meta_title,
				'request'			=> $this->request,
				'article'			=> $article,
			];
			$view = view('pages.blog-post', compact('vars'))->render();
			$this->cache->add($key, $view, env('APP_CACHE_MINUTES'));
		}
		return $view;
	}
}