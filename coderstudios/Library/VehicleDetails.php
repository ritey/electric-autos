<?php

namespace CoderStudios\Library;

use Goutte\Client as Scraper;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use CoderStudios\Library\Dealer;
use CoderStudios\Library\Resource;
use CoderStudios\Library\Upload;
use CoderStudios\Traits\UUID;
use Storage;

class VehicleDetails {

	use UUID;

	public function __construct(Scraper $scraper, Dealer $dealer, Resource $resource, Upload $upload)
	{
		$this->scraper = $scraper;
		$this->dealer = $dealer;
		$this->resource = $resource;
		$this->upload = $upload;
	}

	public function fetch($reg)
	{
		$crawler = $this->scraper->request('GET','https://www.vehiclecheck.co.uk/?vrm='.$reg);

		$dom = $crawler->filterXPath("//*[contains(@class, 'InnerContent')]");

		$title = $dom->filter('div#searchResult > h3');

		$title = $title->text();

		$body = $dom->filter('table#vrmSearchTable tr > td')->extract(['_text']);

		$details['title'] = $this->strip($title);
		$details['reg'] = $reg;
		$details['shell'] = isset($body[3]) ? $body[3] : '';
		$details['doors'] = isset($body[3]) ? trim(substr($body[3],0,2)) : '';
		$details['body'] = isset($body[3]) ? trim(str_replace($details['doors'],'',str_replace('Door','',$body[3]))) : '';
		$details['colour'] = isset($body[5]) ? $body[5] : '';
		$details['registered'] = isset($body[7]) ? $body[7] : '';
		$details['year'] = isset($body[7]) ? $this->stripMonths($body[7]) : '';
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

	private function makeSlug($text)
	{
		return str_replace(',','',str_replace(')','',str_replace('(','',str_replace('/','-',str_replace(' ','-',$text)))));
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
            $data['user_id'] = 1;
            $this->upload->create($data);

            $meta = null;
            $data = null;
            $result = null;
		}
		$resource = null;
		$image = null;
		return true;
	}

	public function scrape()
	{

		$pages = [
			'http://www.pistonheads.com/classifieds?Category=used-cars&M=2654&M=2655&M=1202',
			'http://www.pistonheads.com/classifieds?Category=used-cars&M=2505&M=2897',
			'http://www.pistonheads.com/classifieds?Category=used-cars&M=1233',
			'http://www.pistonheads.com/classifieds?Category=used-cars&FuelType=ELE&M=2175',
		];

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

					$resource['name'] = !empty($ad['title']) ? $ad['title'] : '';
					$resource['slug'] = $this->makeSlug($resource['name']);
					$resource['price'] = $ad['price'];
					$resource['currency'] = $ad['currency'];
					$resource['make_id'] = 0;

					if (strpos(strtolower(' ' . $resource['name']),'bmw')) {
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

					$resource['model_id'] = 0;

					if ($resource['make_id'] == 8 && strpos(strtolower($resource['name']),' model s ')) {
						$resource['model_id'] = 11;
					}
					if ($resource['make_id'] == 8 && strpos(strtolower($resource['name']),' model x ')) {
						$resource['model_id'] = 12;
					}
					if ($resource['make_id'] == 8 && strpos(strtolower($resource['name']),' roadster ')) {
						$resource['model_id'] = 13;
					}

					if ($resource['make_id'] == 1 && strpos(strtolower($resource['name']),' i3 ')) {
						$resource['model_id'] = 1;
					}
					if ($resource['make_id']	 == 1 && strpos(strtolower($resource['name']),' i8 ')) {
						$resource['model_id'] = 2;
					}

					if ($resource['make_id'] == 9 && strpos(strtolower($resource['name']),' prius ')) {
						$resource['model_id'] = 14;
					}

					$resource['price'] = str_replace(',','',$ad['price']);
					$resource['mileage'] = isset($ad['specs'][0]) ? $ad['specs'][0] : '';
					$resource['gearbox'] = isset($ad['specs'][3]) ? $ad['specs'][3] : '';
					$resource['year'] = substr($ad['title'], strlen($ad['title'])-5, 4);

					$crawler2 = $this->scraper->request('GET',$ad['link']);

					$dom = $crawler2->filter('.advert-description');
					$resource['content'] = $this->strip($dom->text());

					$dom = $crawler2->filter('.contact-panel--about__dealer');
					$dealer['name'] = '';
					if (count($dom)) {
						$dealer['name'] = $this->strip($dom->text());
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

					$dom = $crawler2->filter('.contact-panel--about__dealer-link');
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

					$created_resource = $this->resource->create($resource);


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
