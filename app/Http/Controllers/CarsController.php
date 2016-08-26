<?php

namespace App\Http\Controllers;

class CarsController extends BaseController
{

	public function index()
	{
		$vars = [
			'cars' => ['1',2,3,4,5,6,7,8,9],
		];
		return view('pages.cars-index',compact('vars'));
	}

	public function brand($brand)
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.cars-post',compact('vars'));
	}

	public function post($brand = '', $slug)
	{
		$vars = [
			'featured' => ['1',2,3],
			'latest' => ['1',2,3],
		];
		return view('pages.cars-post',compact('vars'));
	}
}