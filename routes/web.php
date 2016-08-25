<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::get('/terms', ['as' => 'terms', 'uses' => 'HomeController@terms']);
Route::get('/privacy', ['as' => 'privacy', 'uses' => 'HomeController@privacy']);
Route::get('/start-selling', ['as' => 'start-selling', 'uses' => 'HomeController@start']);
Route::get('/seller-faqs', ['as' => 'seller-faqs', 'uses' => 'HomeController@faqs']);

Route::get('/blog', ['as' => 'blog.index', 'uses' => 'BlogController@index']);
Route::get('/blog/{slug}', ['as' => 'blog.post', 'uses' => 'BlogController@post']);
Route::get('/cars', ['as' => 'cars.index', 'uses' => 'CarsController@index']);
Route::get('/cars/{brand}', ['as' => 'cars.brand.index', 'uses' => 'CarsController@brand']);
Route::get('/cars/{brand}/{slug}', ['as' => 'cars.brand.car', 'uses' => 'CarsController@post']);