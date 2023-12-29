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
    Route::post('/', 'PartnerController@create');
    Route::delete('/{id}', 'PartnerController@delete');
    Route::post('/update/{id}', 'PartnerController@update');
});

Route::group(["prefix" => 'gallery'], function () {
    Route::get('/', 'GalleryController@index');
    Route::get('/tags/', 'GalleryController@getOnTags');
    Route::get('/{id}', 'GalleryController@get');
    Route::get('/limit/{limit}', 'GalleryController@getLimited');
    Route::post('/', 'GalleryController@create');
    Route::delete('/{id}', 'GalleryController@delete');
    Route::post('/update/{id}', 'GalleryController@update');
});

Route::group(["prefix" => 't-shirt'], function () {
    Route::get('/', 'TShirtController@index');
    Route::get('/available/', 'TShirtController@getAvailable');
    Route::get('/{id}', 'TShirtController@get');
    Route::get('/limit/{limit}', 'TShirtController@getLimited');
    Route::post('/', 'TShirtController@create');
    Route::delete('/{id}', 'TShirtController@delete');
    Route::post('/update/{id}', 'TShirtController@update');
});

Route::group(["prefix" => 'booking'], function () {
    Route::get('/', 'BookingController@index');
    Route::get('/group/', 'BookingController@indexGroup');
    Route::get('/{id}', 'BookingController@get');
    Route::get('/reference/{reference}', 'BookingController@getBooking');
    Route::get('/email/{id}', 'BookingController@sendEmail');
    Route::get('/limit/{limit}', 'BookingController@getLimited');
    Route::get('/group/limit/{limit}', 'BookingController@getGroupLimited');
    Route::get('/admin/dashboard/', 'BookingController@getDashboard');
    Route::post('/', 'BookingController@create');
    Route::post('/group/', 'BookingController@createGroup');
    Route::post('/admin/', 'BookingController@adminCreate');
    Route::post('/admin/group', 'BookingController@adminGroupCreate');
    Route::delete('/{id}', 'BookingController@delete');
    Route::post('/update/{id}', 'BookingController@update');
    Route::post('/update/group/{id}', 'BookingController@updateGroup');
});

Route::group(["prefix" => 'booking-payment'], function () {
    Route::post('/', 'BookingPaymentController@paymentReceived');
});

Route::group(["prefix" => 'user'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/{id}', 'UserController@get');
    Route::post('/', 'UserController@create');
    Route::delete('/{id}', 'UserController@delete');
    Route::post('/update/{id}', 'UserController@update');
});

Route::group(["prefix" => 'role'], function () {
    Route::get('/', 'RoleController@index');
});

Route::group(["prefix" => 'contact-us'], function () {
    Route::get('/', 'ContactUsController@index');
    Route::get('/{id}', 'ContactUsController@get');
    Route::get('/limit/{limit}', 'ContactUsController@getLimited');
    Route::post('/', 'ContactUsController@create');
    Route::delete('/{id}', 'ContactUsController@delete');
    Route::post('/update/{id}', 'ContactUsController@update');
});
