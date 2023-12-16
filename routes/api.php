<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => 'partner'], function () {
    Route::get('/', 'PartnerController@index');
    Route::get('/{id}', 'PartnerController@get');
    Route::get('/limit/{limit}', 'PartnerController@getLimited');
    Route::post('/', 'PartnerController@create')->middleware(['tokenVerification', 'adminVerification']);
    Route::delete('/{id}', 'PartnerController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'PartnerController@update')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 'gallery'], function () {
    Route::get('/', 'GalleryController@index');
    Route::get('/{id}', 'GalleryController@get');
    Route::get('/limit/{limit}', 'GalleryController@getLimited');
    Route::post('/', 'GalleryController@create')->middleware(['tokenVerification', 'adminVerification']);
    Route::delete('/{id}', 'GalleryController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'GalleryController@update')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 't-shirt'], function () {
    Route::get('/', 'TShirtController@index');
    Route::get('/{id}', 'TShirtController@get');
    Route::get('/limit/{limit}', 'TShirtController@getLimited');
    Route::post('/', 'TShirtController@create')->middleware(['tokenVerification', 'adminVerification']);
    Route::delete('/{id}', 'TShirtController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'TShirtController@update')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 'booking'], function () {
    Route::get('/', 'BookingController@index')->middleware(['tokenVerification']);
    Route::get('/group/', 'BookingController@indexGroup')->middleware(['tokenVerification']);
    Route::get('/{id}', 'BookingController@get')->middleware(['tokenVerification']);
    Route::get('/limit/{limit}', 'BookingController@getLimited')->middleware(['tokenVerification']);
    Route::get('/group/limit/{limit}', 'BookingController@getGroupLimited')->middleware(['tokenVerification']);
    Route::post('/', 'BookingController@create');
    Route::post('/admin/', 'BookingController@adminCreate')->middleware(['tokenVerification']);
    Route::post('/admin/group', 'BookingController@adminGroupCreate')->middleware(['tokenVerification']);
    Route::delete('/{id}', 'BookingController@delete')->middleware(['tokenVerification']);
    Route::post('/update/{id}', 'BookingController@update')->middleware(['tokenVerification']);
    Route::post('/update/group/{id}', 'BookingController@updateGroup')->middleware(['tokenVerification']);
});
