<?php

namespace CoderStudios\Library;

use Goutte\Client as Scraper;
use Carbon\Carbon;

class VehicleDetails {

	public function __construct(Scraper $scraper)
	{
		$this->scraper = $scraper;
	}

	public function fetch($reg)
	{

		$crawler = $this->scraper->request('GET','https://www.vehiclecheck.co.uk/?vrm='.$reg);

		$dom = $crawler->filterXPath("//*[contains(@class, 'InnerContent')]");

		$title = $dom->filter('div#searchResult > h3');

		$title = $title->text();

		$body = $dom->filter('table#vrmSearchTable tr > td')->extract(['_text']);

		$details['title'] = trim(preg_replace('/\s+/',' ',$title));
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

}
