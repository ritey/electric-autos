<?php

namespace CoderStudios\Library;

use Illuminate\Contracts\Cache\Repository as Cache;
use Goutte\Client as Scraper;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use CoderStudios\Library\Dealer;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Upload;
use CoderStudios\Models\Models as CarModels;
use CoderStudios\Models\Makes as CarMakes;
use CoderStudios\Traits\UUID;
use Storage;

class VehicleDetails {

	use UUID;

	public function __construct(Cache $cache,Scraper $scraper, Dealer $dealer, Resource $resource, Upload $upload, CarMakes $makes, CarModels $models)
	{
		$this->scraper = $scraper;
		$this->dealer = $dealer;
		$this->resource = $resource;
		$this->upload = $upload;
		$this->makes = $makes;
		$this->models = $models;
		$this->cache = $cache;
	}

	public function buildCar($car)
	{
		$key = md5($car->slug);
		$data = [];
		if ($this->cache->has($key)) {
			$data = $this->cache->get($key);
		} else {
			$first_image = $car->images()->first();
			if (is_object($car->dealer) && empty($car->dealer->slug)) {
				$dealer = $car->dealer;
				$dealer->slug = $this->makeSlug($dealer->name) . '-' . $dealer->id;
				$dealer->save();
			}
			$data = [
				'id'				=> $car->id,
				'ad_slug' 			=> route('cars.brand.car', ['brand' => strtolower(str_replace(' ','+',$car->make->name)), 'version' => str_replace(' ','+',strtolower($car->model->name)), 'slug' => $car->slug]),
				'image_count' 		=> $car->images_count,
				'img_url'			=> is_object($first_image) ? route('image') . '?id=' . $first_image->user_id . '&folder=' . $car->id . '&filename=' . urlencode($first_image->maskname . '.' . $first_image->extension) . '&width=370&height=300' : '#',
				'name'				=> '',
				'make'				=> $car->make->name,
				'model'				=> $car->model->name,
				'year'				=> $car->year,
				'price'				=> $car->price,
				'currency'			=> $car->currency,
				'mileage'			=> $car->mileage,
				'mileage_measure' 	=> $car->length_measure,
				'private'			=> is_object($car->dealer) ? 0 : 1,
				'dealer_url'		=> is_object($car->dealer) ? route('dealers.dealer', $car->dealer->slug) : '',
			];
			$this->cache->add($key, $data, env('APP_CACHE_MINUTES'));
		}

		return $data;
	}

	public function fetch($reg)
	{
		$details['title'] = '';
		$details['reg'] = $reg;
		$details['shell'] = '';
		$details['doors'] = '';
		$details['body'] = '';
		$details['colour'] = '';
		$details['registered'] = '';
		$details['year'] = '';
		$details['make_id'] = 0;
		$details['model_id'] = 0;

		$crawler = $this->scraper->request('GET','https://www.vehiclecheck.co.uk/?vrm='.$reg);

		$dom = $crawler->filterXPath("//*[contains(@class, 'InnerContent')]");

		$title = $dom->filter('div#searchResult > h3');

		if ($title->count()) {
			$title = $title->text();
			$body = $dom->filter('table#vrmSearchTable tr > td')->extract(['_text']);
			$details['title'] = $this->strip($title);
			$details['reg'] = $reg;
			$details['shell'] = isset($body[3]) ? $body[3] : '';
			$details['doors'] = isset($body[3]) ? trim(substr($body[3],0,2)) : '';
			$details['body'] = isset($body[3]) ? trim(str_replace($details['doors'],'',str_replace('Door','',$body[3]))) : '';
			$details['colour'] = isset($body[5]) ? $body[5] : '';
			$details['registered'] = isset($body[7]) ? $body[7] : '';
			$details['year'] = isset($body[7]) ? trim($this->stripMonths($body[7])) : '';
			$details['make_id'] = $this->matchMake($details['title']);
			$details['model_id'] = $this->matchModel($details['make_id'],$details['title']);
		}
		return $details;
	}

	private function stripMonths($string)
	{
		for($i=1;$i<=12;$i++) {
			$dateObj   = Carbon::createFromFormat('!m', $i);
			$monthName = $dateObj->format('F');
			$string = str_replace($monthName,'', $string);
		}
		return $string;
	}

	private function getChildren($node) {
		if ($node->hasChildNodes()) {
			if ($node->nodeName != '#text') {
				return $node->childNodes;
			}
		}
		return $node;
	}

	private function strip($text)
	{
		return trim(preg_replace('/\s+/',' ',$text));
	}

	public function makeSlug($text)
	{
		return strtolower(str_replace('"','',str_replace('--','-',str_replace(' ','+',str_replace('\'\'','',str_replace('*','-',str_replace('&','-',str_replace(',','',str_replace(')','',str_replace('(','',str_replace('/','-',str_replace(' ','-',$text))))))))))));
	}

	public function makeName($text)
	{
		return str_replace('‘','',str_replace('  ',' ',str_replace('\'\'','',str_replace('*','',str_replace('&','&',str_replace(',',' ',str_replace(')','',str_replace('(','',str_replace('/','',str_replace(' ',' ',$text))))))))));
	}

	public function makeMileage($text)
	{
		if ($text == 'Petrol' || $text == '228 bhp') {
			return 0;
		}
		return trim(str_replace(',','',str_replace('kilometer','',str_replace('kilometers','',str_replace('miles','',$text)))));
	}

	public function makePrice($text)
	{
		return str_replace('POA','0.00',str_replace(',','',$text));
	}

	protected function getDoc($path)
	{
		$ch =  curl_init($path);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$ch = null;
		return $result;
	}

	protected function saveImage($resource, $image)
	{
		$name = basename($image);
		$new_name = md5(basename($image) . date('Y-m-d'));

		if (!file_exists(storage_path('app/uploads/' . $resource->id) . '/' . $name)) {

			$result = Storage::put('uploads/' . $resource->id . '/' . $name, $this->getDoc($image));

			$meta = pathinfo(storage_path('app/uploads/' . $resource->id . '/' . $name));

			Storage::copy('uploads/' . $resource->id . '/' . $name, 'uploads/' . $resource->id . '/' . $new_name . '.' . $meta['extension']);

            $data = [];
            $data['filename'] = basename($image);
            $data['maskname'] = $new_name;
            $data['extension'] = $meta['extension'];
            $data['size'] = filesize(storage_path('app/uploads/' . $resource->id) . '/' . $new_name . '.' . $meta['extension']);
            $data['folder'] = $resource->id;
            $data['user_id'] = '95b688b2-d332-4e42-afb4-ed98c02bc607';
            $this->upload->create($data);

            $meta = null;
            $data = null;
            $result = null;
		}
		$resource = null;
		$image = null;
		return true;
	}

	public function matchMake($title)
	{
		$make_id = 0;
		$makes = $this->makes->get();
		$title_parts = explode(' ',$title);
		foreach($title_parts as $word) {
			foreach($makes as $make) {
				if (strtolower($word) == strtolower($make->name)) {
					$make_id = $make->id;
					break;
				}
			}
		}
		return $make_id;
	}

	public function matchModel($make_id, $title)
	{
		$model_id = 0;
		$models = $this->models->where('make_id',$make_id)->get();
		$title_parts = explode(' ',$title);

		foreach($models as $model) {
			if (strpos(' '.strtolower($title), strtolower($model->name))) {
				$model_id = $model->id;
			}
		}

		if ($model_id == 0) {
			foreach($title_parts as $word) {
				foreach($models as $model) {
					if (strtolower($word) == strtolower($model->name)) {
						$model_id = $model->id;
						dd($model->name);
						break;
					}
				}
			}
		}
		return $model_id;
	}

	public function scrape()
	{

		$pages = [
			'http://www.pistonheads.com/classifieds?Category=used-cars&M=2654&M=2655&M=1202',
			'http://www.pistonheads.com/classifieds?Category=used-cars&M=2505&M=2897',
			'http://www.pistonheads.com/classifieds?Category=used-cars&M=1233',
			'http://www.pistonheads.com/classifieds?Category=used-cars&FuelType=ELE&M=2175',
		];

		$folders = Storage::directories('uploads');
		foreach($folders as $folder) {
			Storage::deleteDirectory($folder);
		}
		$this->upload->truncate();
		$this->resource->truncate();

		foreach($pages as $type) {

			$crawler = $this->scraper->request('GET',$type);

			$dom = $crawler->filterXPath("//*[contains(@id, 'search-results')]");

			$ads = $dom->filter('div.result-contain')->each( function (Crawler $node, $i) {

				$details = [];
				$item = $node->filter('div.ad-listing div.listing-headline a > h3');
				$details['title'] = '';
				$details['price'] = '';
				$details['link'] = '';
				if (count($item)) {
					$details['title'] = $item->text();
					if (empty($details['title'])) {
						dd($item);
					}
				}

				$item = $node->filter('div.ad-listing div.listing-headline .price');
				$details['currency'] = 'Pound';
				if (count($item)) {
					$details['currency'] = 'Pound';
					if (strpos($item->text(), '€')) {
						$details['currency'] = 'Euro';
					}
					if (strpos($item->text(), '£')) {
						$details['currency'] = 'Pound';
					}
					$details['price'] = str_replace('€','',str_replace('£','',$item->text()));
				}

				$item = $node->filter('div.ad-listing div.listing-headline a');
				if (count($item)) {
					$details['link'] = 'http://www.pistonheads.com' . $item->attr('href');
				}

				$specs = $node->filter('div.ad-listing div.listing-content div.listing-info .specs > li')->each( function (Crawler $node, $i) {

					return $this->strip($node->text());

				});

				$details['specs'] = $specs;

				//$details['price'] = $item->text();
				//
				//dd($details);

				return $details;

			});

			foreach ($ads as $ad) {

				ini_set('set_time_limit',60);

				if (!empty($ad['title'])) {

					$resource['name'] = !empty($ad['title']) ? $this->makeName($ad['title']) : '';
					$resource['slug'] = $this->makeSlug($resource['name']);
					$resource['price'] = $ad['price'];
					$resource['currency'] = $ad['currency'];
					$resource['make_id'] = 1;

					if (strpos(strtolower(' ' . $resource['name']),'bmw')) {
						$resource['make_id'] = 1;
					}
					if (strpos(strtolower(' ' . $resource['name']),'i8')) {
						$resource['make_id'] = 1;
					}
					if (strpos(strtolower(' ' . $resource['name']),'i3')) {
						$resource['make_id'] = 1;
					}
					if (strpos(strtolower(' ' . $resource['name']),'tesla')) {
						$resource['make_id'] = 8;
					}
					if (strpos(strtolower(' ' . $resource['name']),'toyota')) {
						$resource['make_id'] = 9;
					}
					if (strpos(strtolower(' ' . $resource['name']),'volkswagen') || strpos(strtolower($resource['name']),'vw')) {
						$resource['make_id'] = 11;
					}

					$resource['model_id'] = 1;

					if ($resource['make_id'] == 8 && strpos(strtolower(' ' . $resource['name']),' model s ')) {
						$resource['model_id'] = 11;
					}
					if ($resource['make_id'] == 8 && strpos(strtolower(' ' . $resource['name']),' model x ')) {
						$resource['model_id'] = 12;
					}
					if ($resource['make_id'] == 8 && strpos(strtolower(' ' . $resource['name']),' roadster ')) {
						$resource['model_id'] = 13;
					}

					if ($resource['make_id'] == 1 && strpos(strtolower(' ' . $resource['name']),' i3 ')) {
						$resource['model_id'] = 1;
					}
					if ($resource['make_id']	 == 1 && strpos(strtolower(' ' . $resource['name']),' i8 ')) {
						$resource['model_id'] = 2;
					}

					if ($resource['make_id'] == 9 && strpos(strtolower(' ' . $resource['name']),' prius ')) {
						$resource['model_id'] = 14;
					}

					if ($resource['make_id'] == 9 && strpos(strtolower(' ' . $resource['name']),' prius+ ')) {
						$resource['model_id'] = 14;
					}

					if ($resource['make_id'] == 11 && (strpos(strtolower(' ' . $resource['name']),' golf ')) || strpos(strtolower(' ' . $resource['name']),' e-golf ') ) {
						$resource['model_id'] = 16;
					}

					$resource['price'] = $this->makePrice($ad['price']);
					$resource['mileage'] = isset($ad['specs'][0]) ? $ad['specs'][0] : '';
					$resource['length_measure'] = 'Miles';
					if (strpos(strtolower($resource['mileage']), 'km')) {
						$resource['length_measure'] = 'KM';
					}
					if (strpos(strtolower($resource['mileage']), 'kilometer')) {
						$resource['length_measure'] = 'KM';
					}
					$resource['mileage'] = $this->makeMileage($resource['mileage']);
					$resource['gearbox'] = isset($ad['specs'][3]) ? $ad['specs'][3] : '';
					$resource['year'] = substr($ad['title'], strlen($ad['title'])-5, 4);

					$crawler2 = $this->scraper->request('GET',$ad['link']);

					$dom = $crawler2->filter('.advert-description');
					$resource['content'] = $this->strip($dom->text());

					$dom = $crawler2->filter('.contact-panel--about__dealer');
					$dealer['name'] = '';
					if (count($dom)) {
						$dealer['name'] = $this->strip($dom->text());
						$dealer['slug'] = $this->makeSlug($dealer['name']);
					}

					$dom = $crawler2->filter('.contact-panel--about__location');
					$dealer['location'] = $this->strip($dom->text());

					$dom = $crawler2->filter('.phone-numbers');
					$dealer['phone'] = '';
					$dealer['mobile'] = '';
					if (count($dom)) {
						$phone = explode(' ',trim(str_replace('Call:','',$this->strip($dom->text()))));
						$dealer['phone'] = isset($phone[0]) ? $phone[0] : '';
						$dealer['mobile'] = isset($phone[2]) ? $phone[2] : '';
					}

					$dom = $crawler2->filter('div#contact-and-about-tab2 p > a[href*=\'http\']');
					$dealer['website'] = '';
					if (count($dom)) {
						$dealer['website'] = $this->strip($dom->attr('href'));
					}

					//dd(['ad' => $ad, 'resource' => $resource, 'dealer' => $dealer]);

					if (!empty($dealer['name'])) {
						$resource['private'] = 0;
						if (!$existing_dealer = $this->dealer->dealerExists($dealer['name'])) {
							$dealer['dealer_id'] = $this->Uuid(openssl_random_pseudo_bytes(16));
							$existing_dealer = $this->dealer->create($dealer);
						}
					} else {
						// Private sellers are still created as a dealer, just Private in name
						$dealer['name'] = 'Private-' . mt_rand(1,100) . '-' . date('YmdHis');
						$dealer['dealer_id'] = $this->Uuid(openssl_random_pseudo_bytes(16));
						$resource['private'] = 1;
						$existing_dealer = $this->dealer->create($dealer);
					}

					$resource['user_id'] = 1;
					$resource['dealer_id'] = $existing_dealer->id;

					//dd($resource);
					//Log::info(print_r($resource,true));

					$created_resource = $this->resource->create($resource);

					$data = [
						'slug' => $resource['slug'] . '-' . $created_resource->id,
					];

					$this->resource->update($created_resource->id, $data);

					//dd($dealer);

					$dom = $crawler2->filter('.theImage');
					$images = [];
					foreach($dom as $img) {
						ini_set('set_time_limit',60);
						$images[] = $img->getAttribute('src');
					}

					foreach($images as $image) {
						$this->saveImage($created_resource,$image);
					}

					//dd($dealer);
					//
					//echo '<xmp>' . print_r($dealer,true) . '</xmp>';
					//echo '<xmp>' . print_r($resource,true) . '</xmp>';
				}

			}
		}

		dd('done');

	}

}
