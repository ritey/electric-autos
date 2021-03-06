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

Route::group( [ 'namespace' => 'Admin', 'middleware' => 'admin_auth', 'prefix' => '_admin' , 'as' => 'admin.' ] , function() {

	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);

	Route::get('/clear-cache', ['as' => 'clear-cache', 'uses' => 'HomeController@clear']);
	Route::get('/log', ['as' => 'log', 'uses' => 'HomeController@log']);
	Route::get('/clear-log', ['as' => 'clear-log', 'uses' => 'HomeController@clearLog']);

	Route::get('/ads', ['as' => 'ads', 'uses' => 'AdsController@index']);
	Route::get('/ads/{id}/edit', ['as' => 'ads.edit', 'uses' => 'AdsController@edit']);
	Route::post('/ads/{id}/edit', ['as' => 'ads.update', 'uses' => 'AdsController@update']);

	Route::get('/posts', ['as' => 'posts', 'uses' => 'BlogController@index']);
	Route::get('/posts/create', ['as' => 'posts.create', 'uses' => 'BlogController@create']);
	Route::get('/posts/{id}/edit', ['as' => 'posts.edit', 'uses' => 'BlogController@edit']);
	Route::post('/posts/{id}/edit', ['as' => 'posts.update', 'uses' => 'BlogController@update']);
	Route::post('/posts/store', ['as' => 'posts.store', 'uses' => 'BlogController@store']);

	Route::get('/subscriptions', ['as' => 'subscriptions', 'uses' => 'SubscriptionsController@index']);

	Route::get('/users', ['as' => 'users', 'uses' => 'UsersController@index']);
	Route::get('/users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
	Route::post('/users/{id}/edit', ['as' => 'users.update', 'uses' => 'UsersController@update']);

	Route::get('/data/makes', ['as' => 'makes', 'uses' => 'MakesController@index']);
	Route::get('/data/makes/create', ['as' => 'makes.create', 'uses' => 'MakesController@create']);
	Route::post('/data/makes', ['as' => 'makes.store', 'uses' => 'MakesController@store']);
	Route::get('/data/makes/{id}/edit', ['as' => 'makes.edit', 'uses' => 'MakesController@edit']);
	Route::post('/data/makes/{id}/update', ['as' => 'makes.update', 'uses' => 'MakesController@update']);
	Route::get('/data/models', ['as' => 'models', 'uses' => 'ModelsController@index']);
	Route::get('/data/models/create', ['as' => 'models.create', 'uses' => 'ModelsController@create']);
	Route::post('/data/models', ['as' => 'models.store', 'uses' => 'ModelsController@store']);
	Route::get('/data/models/{id}/edit', ['as' => 'models.edit', 'uses' => 'ModelsController@edit']);
	Route::post('/data/models/{id}/update', ['as' => 'models.update', 'uses' => 'ModelsController@update']);

	Route::get('/pics', ['as' => 'pic.index', 'uses' => 'BlogController@images']);
	Route::get('/pics/{article}', ['as' => 'pic.ad.index', 'uses' => 'BlogController@images']);
	Route::post('/pics/save', ['as' => 'pic.save', 'uses' => 'BlogController@saveImage']);
	Route::get('/pics/{id}/delete', ['as' => 'pic.ad.delete', 'uses' => 'BlogController@deleteImage']);

});

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::get('/password/email', ['as' => 'password-email', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('/password/email', ['as' => 'password-email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);

Route::get('/password/reset/{token}', ['as' => 'password-reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('/password/reset/', ['as' => 'password-reset', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('/register', ['as' => 'register-post', 'uses' => 'Auth\RegisterController@register']);

Route::get('/profile', ['as' => 'profile', 'uses' => 'AccountController@profile']);
Route::post('/profile/save', ['as' => 'profile-save', 'uses' => 'AccountController@profileUpdate']);

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AccountController@dashboard']);
Route::get('/dashboard/upgrade', ['as' => 'upgrade', 'uses' => 'AccountController@upgrade']);
Route::post('/dashboard/upgrading', ['as' => 'upgrade.process', 'uses' => 'AccountController@processUpgrade']);
Route::get('/dashboard/dealer', ['as' => 'dealer.edit', 'uses' => 'AccountController@dealer']);
Route::post('/dashboard/dealer/save', ['as' => 'dealer.save', 'uses' => 'AccountController@saveDealer']);
Route::get('/dashboard/ads/create', ['as' => 'ad.create', 'uses' => 'AdvertController@create']);
Route::get('/dashboard/ads/create/details', ['as' => 'ad.create.details', 'uses' => 'AdvertController@createDetails']);
Route::get('/dashboard/ads/create/save', ['as' => 'ad.create.save', 'uses' => 'AdvertController@saveNew']);
Route::get('/dashboard/ads/{slug}', ['as' => 'ad.edit', 'uses' => 'AdvertController@edit']);
Route::post('/dashboard/ads/{slug}', ['as' => 'ad.save', 'uses' => 'AdvertController@save']);
Route::get('/dashboard/pics', ['as' => 'pic.index', 'uses' => 'PicsController@index']);
Route::get('/dashboard/{ad}/pics', ['as' => 'pic.ad.index', 'uses' => 'PicsController@index']);

Route::get('/dashboard/{ad}/pics/{id}/delete', ['as' => 'pic.ad.delete', 'uses' => 'PicsController@delete']);
Route::get('/dashboard/pics/{id}/delete', ['as' => 'pic.delete', 'uses' => 'PicsController@delete']);

Route::post('/dashboard/pics/save', ['as' => 'pic.save', 'uses' => 'PicsController@save']);

Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::post('/contact', ['as' => 'contact.send', 'uses' => 'HomeController@sendContact']);

Route::get('/terms', ['as' => 'terms', 'uses' => 'HomeController@terms']);
Route::get('/privacy-policy', ['as' => 'privacy', 'uses' => 'HomeController@privacy']);
Route::get('/cookie-policy', ['as' => 'cookie', 'uses' => 'HomeController@cookie']);
Route::get('/start-selling', ['as' => 'start-selling', 'uses' => 'HomeController@start']);
Route::get('/start-selling/car-details', ['as' => 'start-selling.details', 'uses' => 'AdvertController@details']);
Route::get('/start-selling/user-details', ['as' => 'start-selling.user-details', 'uses' => 'AdvertController@saveVehicle']);
Route::get('/start-selling/complete', ['as' => 'start-selling.complete', 'uses' => 'AdvertController@saveUser']);
Route::get('/seller-faqs', ['as' => 'seller-faqs', 'uses' => 'HomeController@faqs']);

Route::get('/sitemap.xml', ['as' => 'sitemap', 'uses' => 'SitemapController@sitemap']);
Route::get('/image.png', ['as' => 'image', 'uses' => 'ImageController@index']);

Route::get('/blog', ['as' => 'blog.index', 'uses' => 'BlogController@index']);
Route::get('/blog/{slug}', ['as' => 'blog.post', 'uses' => 'BlogController@article']);
Route::get('/used-cars', ['as' => 'cars.index', 'uses' => 'CarsController@index']);
Route::get('/used-cars/{brand}', ['as' => 'cars.brand.index', 'uses' => 'CarsController@brand']);
Route::get('/used-cars/{brand}/{version?}', ['as' => 'cars.search.index', 'uses' => 'CarsController@model']);
Route::get('/used-cars/{brand}/{version}/{slug}', ['as' => 'cars.brand.car', 'uses' => 'CarsController@post']);

Route::get('/makes/{make_id}/models', ['as' => 'make.models', 'uses' => 'ApiController@makesModels']);

Route::get('/dealer/{slug}', ['as' => 'dealers.dealer', 'uses' => 'DealerController@dealer']);