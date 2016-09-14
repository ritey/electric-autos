<?php

namespace CoderStudios\Library;

use CoderStudios\Models\Tweets as TweetModel;
use Goutte\Client as Scraper;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use Cache;

class Tweets {

	protected $tweets;

	public function __construct(TweetModel $model)
	{
		$this->tweets = $model;
	}

	public static function scrapeFollowers()
	{

		$result = 1;
		$scraper = new Scraper();
		$value = '';

		try {
			$crawler = $scraper->request('GET','https://twitter.com/electricautosuk');
			$dom = $crawler->filterXPath("//*[contains(@class, 'ProfileNav-item--followers')]");
			$value = $dom->filter('li.ProfileNav-item--followers a > span.ProfileNav-value');
		} catch (\Exception $e) {

		}

		if (empty($value)) {
			dd($value);
		}

		if (is_object($value) && $result = $value->text() ) {
			return $result;
		}

		return $result;
	}

	public static function getFollowers()
	{
		if (Cache::has('twitter_followers')) {
			$result = Cache::get('twitter_followers');
		} else {
			$result = Tweets::scrapeFollowers();
			Cache::add('twitter_followers', $result, 1440);
		}
		return  $result;
	}

	public static function scrapeLikes()
	{

		$result = 1;
		$scraper = new Scraper();

		try {
			$crawler = $scraper->request('GET','https://www.facebook.com/Electric-Autos-1767600990124746/?ref=page_internal');
			$dom = $crawler->filterXPath("//*[contains(@id, 'PagesLikesCountDOMID')]");
			$value = $dom->filter('span');
		} catch (\Exception $e) {

		}

		if (empty($value)) {
			dd($dom);
		}

		if (is_object($value) && $result = $value->text() ) {
			return str_replace('kedvelés','',str_replace('like','',str_replace('likes','',$result)));
		}

		return $result;
	}

	public static function getLikes()
	{
		if (Cache::has('facebook_followers')) {
			$result = Cache::get('facebook_followers');
		} else {
			$result = Tweets::scrapeLikes();
			Cache::add('facebook_followers', $result, 1440);
		}
		return  $result;
	}

	public function all()
	{
		return $this->tweets->all();
	}

	public function findByName($name)
	{
		return $this->tweets->where('name',$name)->get();
	}

	public function findById($id)
	{
		return $this->tweets->where('id',$name)->get();
	}

	public function findNext($date1, $date2)
	{
		return $this->tweets->whereBetween('next_at',[$date1,$date2])->get();
	}

	public function add(array $data)
	{
		return $this->tweets->create($data);
	}

	public function update($id, array $data)
	{
		return $this->tweets->where('id',$id)->update($data);
	}

}