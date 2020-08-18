<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('crawl','CrawlFbController@index')->name('getCrwal');
Route::post('crawl','CrawlFbController@crawlfb')->name('postCrwal');
// Route::get('crawlfb','CrawlAPIController@index')->name('postCrwafb');
