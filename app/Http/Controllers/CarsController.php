<?php

namespace App\Http\Controllers;

class CarsController extends BaseController
{

	public function index()
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.blog-index',compact('vars'));
	}

	public function brand($brand)
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.blog-post',compact('vars'));
	}

	public function post($slug)
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.blog-post',compact('vars'));
	}
}