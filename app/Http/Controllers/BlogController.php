<?php

namespace App\Http\Controllers;

class BlogController extends BaseController
{

	public function index()
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.blog-index',compact('vars'));
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