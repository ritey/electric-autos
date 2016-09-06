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
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::get('/password-reset', ['as' => 'password-reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('/register', ['as' => 'register-post', 'uses' => 'Auth\RegisterController@register']);

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AccountController@dashboard']);

Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);

Route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::post('/contact', ['as' => 'contact.send', 'uses' => 'HomeController@sendContact']);

Route::get('/terms', ['as' => 'terms', 'uses' => 'HomeController@terms']);
Route::get('/privacy-policy', ['as' => 'privacy', 'uses' => 'HomeController@privacy']);
Route::get('/cookie-policy', ['as' => 'cookie', 'uses' => 'HomeController@cookie']);
Route::get('/start-selling', ['as' => 'start-selling', 'uses' => 'HomeController@start']);
Route::get('/start-selling/car-details', ['as' => 'start-selling.details', 'uses' => 'AdvertController@details']);
Route::get('/seller-faqs', ['as' => 'seller-faqs', 'uses' => 'HomeController@faqs']);

Route::get('/sitemap.xml', ['as' => 'sitemap', 'uses' => 'SitemapController@sitemap']);
Route::get('/image.png', ['as' => 'image', 'uses' => 'ImageController@index']);

Route::get('/blog', ['as' => 'blog.index', 'uses' => 'BlogController@index']);
Route::get('/blog/{slug}', ['as' => 'blog.post', 'uses' => 'BlogController@post']);
Route::get('/used-cars', ['as' => 'cars.index', 'uses' => 'CarsController@index']);
Route::get('/used-cars/{brand}', ['as' => 'cars.brand.index', 'uses' => 'CarsController@brand']);
Route::get('/used-cars/{brand}/{model}', ['as' => 'cars.search.index', 'uses' => 'CarsController@brand']);
Route::get('/used-cars/{brand}/{model}/{slug}', ['as' => 'cars.brand.car', 'uses' => 'CarsController@post']);