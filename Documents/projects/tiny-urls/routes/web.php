<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UrlShortenerController@index');
Route::post('get-tiny-url', 'UrlShortenerController@getTinyUrl');
Route::get('top-100', 'UrlShortenerController@getTop100');
Route::get('{slug}', 'UrlShortenerController@checkShortenedUrl');
