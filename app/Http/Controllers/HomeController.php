<?php

namespace App\Http\Controllers;

class HomeController extends BaseController
{

	public function home()
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.home',compact('vars'));
	}

	public function about()
	{
		$vars = [
		];
		return view('pages.about',compact('vars'));
	}

	public function contact()
	{
		$vars = [
		];
		return view('pages.contact',compact('vars'));
	}

	public function terms()
	{
		$vars = [
		];
		return view('pages.terms',compact('vars'));
	}

	public function privacy()
	{
		$vars = [
		];
		return view('pages.privacy',compact('vars'));
	}

	public function start()
	{
		$vars = [
		];
		return view('pages.start',compact('vars'));
	}

	public function faqs()
	{
		$vars = [
		];
		return view('pages.faqs',compact('vars'));
	}

}
