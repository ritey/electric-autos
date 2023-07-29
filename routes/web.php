<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => '\CoderStudios\Controllers\HomeController@home']);

Route::get('/profile', ['as' => 'profile', 'uses' => '\CoderStudios\Controllers\AccountController@profile']);
Route::post('/profile/save', ['as' => 'profile-save', 'uses' => '\CoderStudios\Controllers\AccountController@profileUpdate']);

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => '\CoderStudios\Controllers\AccountController@dashboard']);
Route::get('/dashboard/upgrade', ['as' => 'upgrade', 'uses' => '\CoderStudios\Controllers\AccountController@upgrade']);
Route::post('/dashboard/upgrading', ['as' => 'upgrade.process', 'uses' => '\CoderStudios\Controllers\AccountController@processUpgrade']);
Route::get('/dashboard/dealer', ['as' => 'dealer.edit', 'uses' => '\CoderStudios\Controllers\AccountController@dealer']);
Route::post('/dashboard/dealer/save', ['as' => 'dealer.save', 'uses' => '\CoderStudios\Controllers\AccountController@saveDealer']);
Route::get('/dashboard/ads/create', ['as' => 'ad.create', 'uses' => '\CoderStudios\Controllers\AdvertController@create']);
Route::get('/dashboard/ads/create/details', ['as' => 'ad.create.details', 'uses' => '\CoderStudios\Controllers\AdvertController@createDetails']);
Route::get('/dashboard/ads/create/save', ['as' => 'ad.create.save', 'uses' => '\CoderStudios\Controllers\AdvertController@saveNew']);
Route::get('/dashboard/ads/{slug}', ['as' => 'ad.edit', 'uses' => '\CoderStudios\Controllers\AdvertController@edit']);
Route::post('/dashboard/ads/{slug}', ['as' => 'ad.save', 'uses' => '\CoderStudios\Controllers\AdvertController@save']);
Route::get('/dashboard/pics', ['as' => 'pic.index', 'uses' => '\CoderStudios\Controllers\PicsController@index']);
Route::get('/dashboard/{ad}/pics', ['as' => 'pic.ad.index', 'uses' => '\CoderStudios\Controllers\PicsController@index']);

Route::get('/dashboard/{ad}/pics/{id}/delete', ['as' => 'pic.ad.delete', 'uses' => '\CoderStudios\Controllers\PicsController@delete']);
Route::get('/dashboard/pics/{id}/delete', ['as' => 'pic.delete', 'uses' => '\CoderStudios\Controllers\PicsController@delete']);

Route::post('/dashboard/pics/save', ['as' => 'pic.save', 'uses' => '\CoderStudios\Controllers\PicsController@save']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
        Route::get('/', ['as' => 'index', 'uses' => '\CoderStudios\Controllers\Admin\AdminController@index']);
        Route::get('/clear-cache', ['as' => 'clear-cache', 'uses' => '\CoderStudios\Controllers\Admin\AdminController@clearCache']);
        Route::get('/site-log', ['as' => 'site-log', 'uses' => '\CoderStudios\Controllers\Admin\SiteLogController@index']);
        Route::post('/clear-site-log', ['as' => 'site-log.clear', 'uses' => '\CoderStudios\Controllers\Admin\SiteLogController@delete']);
        Route::get('/error-log', ['as' => 'log', 'uses' => '\CoderStudios\Controllers\Admin\ErrorLogController@index']);
        Route::post('/clear-error-log', ['as' => 'log.clear', 'uses' => '\CoderStudios\Controllers\Admin\ErrorLogController@delete']);

        Route::get('/ads', ['as' => 'ads', 'uses' => '\CoderStudios\Controllers\Admin\AdsController@index']);
        Route::get('/ads/{id}/edit', ['as' => 'ads.edit', 'uses' => '\CoderStudios\Controllers\Admin\AdsController@edit']);
        Route::post('/ads/{id}/edit', ['as' => 'ads.update', 'uses' => '\CoderStudios\Controllers\Admin\AdsController@update']);

        Route::get('/posts', ['as' => 'posts', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@index']);
        Route::get('/posts/create', ['as' => 'posts.create', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@create']);
        Route::get('/posts/{id}/edit', ['as' => 'posts.edit', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@edit']);
        Route::post('/posts/{id}/edit', ['as' => 'posts.update', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@update']);
        Route::post('/posts/store', ['as' => 'posts.store', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@store']);

        Route::get('/subscriptions', ['as' => 'subscriptions', 'uses' => '\CoderStudios\Controllers\Admin\SubscriptionsController@index']);

        Route::get('/users', ['as' => 'users', 'uses' => '\CoderStudios\Controllers\Admin\UsersController@index']);
        Route::get('/users/{id}/edit', ['as' => 'users.edit', 'uses' => '\CoderStudios\Controllers\Admin\UsersController@edit']);
        Route::post('/users/{id}/edit', ['as' => 'users.update', 'uses' => '\CoderStudios\Controllers\Admin\UsersController@update']);

        Route::get('/data/makes', ['as' => 'makes', 'uses' => '\CoderStudios\Controllers\Admin\MakesController@index']);
        Route::get('/data/makes/create', ['as' => 'makes.create', 'uses' => '\CoderStudios\Controllers\Admin\MakesController@create']);
        Route::post('/data/makes', ['as' => 'makes.store', 'uses' => '\CoderStudios\Controllers\Admin\MakesController@store']);
        Route::get('/data/makes/{id}/edit', ['as' => 'makes.edit', 'uses' => '\CoderStudios\Controllers\Admin\MakesController@edit']);
        Route::post('/data/makes/{id}/update', ['as' => 'makes.update', 'uses' => '\CoderStudios\Controllers\Admin\MakesController@update']);
        Route::get('/data/models', ['as' => 'models', 'uses' => '\CoderStudios\Controllers\Admin\ModelsController@index']);
        Route::get('/data/models/create', ['as' => 'models.create', 'uses' => '\CoderStudios\Controllers\Admin\ModelsController@create']);
        Route::post('/data/models', ['as' => 'models.store', 'uses' => '\CoderStudios\Controllers\Admin\ModelsController@store']);
        Route::get('/data/models/{id}/edit', ['as' => 'models.edit', 'uses' => '\CoderStudios\Controllers\Admin\ModelsController@edit']);
        Route::post('/data/models/{id}/update', ['as' => 'models.update', 'uses' => '\CoderStudios\Controllers\Admin\ModelsController@update']);

        Route::get('/pics', ['as' => 'pic.index', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@images']);
        Route::get('/pics/{article}', ['as' => 'pic.ad.index', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@images']);
        Route::post('/pics/save', ['as' => 'pic.save', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@saveImage']);
        Route::get('/pics/{id}/delete', ['as' => 'pic.ad.delete', 'uses' => '\CoderStudios\Controllers\Admin\BlogController@deleteImage']);
    });
});

Route::get('/about', ['as' => 'about', 'uses' => '\CoderStudios\Controllers\HomeController@about']);
Route::get('/contact', ['as' => 'contact', 'uses' => '\CoderStudios\Controllers\HomeController@contact']);
Route::post('/contact', ['as' => 'contact.send', 'uses' => '\CoderStudios\Controllers\HomeController@sendContact']);

Route::get('/terms', ['as' => 'terms', 'uses' => '\CoderStudios\Controllers\HomeController@terms']);
Route::get('/privacy-policy', ['as' => 'privacy', 'uses' => '\CoderStudios\Controllers\HomeController@privacy']);
Route::get('/cookie-policy', ['as' => 'cookie', 'uses' => '\CoderStudios\Controllers\HomeController@cookie']);
Route::get('/start-selling', ['as' => 'start-selling', 'uses' => '\CoderStudios\Controllers\HomeController@start']);
Route::get('/start-selling/car-details', ['as' => 'start-selling.details', 'uses' => '\CoderStudios\Controllers\AdvertController@details']);
Route::get('/start-selling/user-details', ['as' => 'start-selling.user-details', 'uses' => '\CoderStudios\Controllers\AdvertController@saveVehicle']);
Route::get('/start-selling/complete', ['as' => 'start-selling.complete', 'uses' => '\CoderStudios\Controllers\AdvertController@saveUser']);
Route::get('/seller-faqs', ['as' => 'seller-faqs', 'uses' => '\CoderStudios\Controllers\HomeController@faqs']);

Route::get('/image.png', ['as' => 'image', 'uses' => '\CoderStudios\Controllers\ImageController@index']);

Route::get('/blog', ['as' => 'blog.index', 'uses' => '\CoderStudios\Controllers\BlogController@index']);
Route::get('/blog/{slug}', ['as' => 'blog.post', 'uses' => '\CoderStudios\Controllers\BlogController@article']);
Route::get('/used-cars', ['as' => 'cars.index', 'uses' => '\CoderStudios\Controllers\CarsController@index']);
Route::get('/used-cars/{brand}', ['as' => 'cars.brand.index', 'uses' => '\CoderStudios\Controllers\CarsController@brand']);
Route::get('/used-cars/{brand}/{version?}', ['as' => 'cars.search.index', 'uses' => '\CoderStudios\Controllers\CarsController@model']);
Route::get('/used-cars/{brand}/{version}/{slug}', ['as' => 'cars.brand.car', 'uses' => '\CoderStudios\Controllers\CarsController@post']);

Route::get('/makes/{make_id}/models', ['as' => 'make.models', 'uses' => '\CoderStudios\Controllers\ApiController@makesModels']);

Route::get('/dealer/{slug}', ['as' => 'dealers.dealer', 'uses' => '\CoderStudios\Controllers\DealerController@dealer']);
