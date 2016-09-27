<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Cache\Repository as Cache;
use CoderStudios\Models\Makes;
use CoderStudios\Models\Models;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Dealer;

class SitemapController extends BaseController
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
	public function __construct(Request $request, Cache $cache, Resource $resource, Makes $makes, Models $models, Dealer $dealers)
	{
		parent::__construct($cache);
		$this->namespace = __NAMESPACE__;
		$this->basename = class_basename($this);
		$this->request = $request;
		$this->cache = $cache;
		$this->resource = $resource;
		$this->makes = $makes;
		$this->models = $models;
		$this->dealers = $dealers;
	}

	public function sitemap()
	{
		$xml = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
		$xml .= '<url><loc>'.route('home').'</loc><priority>1</priority><lastmod>2016-09-01T09:00:00+00:00</lastmod><changefreq>daily</changefreq></url>';

		$resources = $this->resource->all();
		foreach( $resources as $vehicle) {
			$xml .= '<url><loc>'.route('home').'/used-cars/'.strtolower(str_replace(' ','+',$vehicle->make()->first()->name)).'/'.strtolower(str_replace(' ','+',$vehicle->model()->first()->name)).'/'.$vehicle->slug.'</loc><priority>0.9</priority><lastmod>'.$vehicle->updated_at->toAtomString().'</lastmod><changefreq>daily</changefreq></url>';
		}

		$dealers = $this->dealers->all();
		foreach( $dealers as $dealer) {
			$xml .= '<url><loc>'.route('dealers.dealer', ['slug' => $dealer->slug]).'</loc><priority>0.9</priority><lastmod>'.$dealer->updated_at->toAtomString().'</lastmod><changefreq>monthly</changefreq></url>';
		}

		$xml .= '<url><loc>'.route('home').'/about</loc><priority>0.9</priority><lastmod>2016-09-01T09:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>';
		$xml .= '<url><loc>'.route('home').'/start-selling</loc><priority>0.9</priority><lastmod>2016-09-01T09:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>';
		$xml .= '<url><loc>'.route('home').'/seller-faqs</loc><priority>0.9</priority><lastmod>2016-09-01T09:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>';
		$xml .= '<url><loc>'.route('home').'/blog</loc><priority>0.9</priority><lastmod>2016-09-01T09:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>';

		$xml .= '</urlset>';

        return (new Response($xml, 200))
              ->header('Content-Type', 'text/xml');
	}

}