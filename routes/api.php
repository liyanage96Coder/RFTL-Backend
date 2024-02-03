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
    Route::get('/tags/', 'GalleryController@getOnTags');
    Route::get('/{id}', 'GalleryController@get');
    Route::get('/limit/{limit}', 'GalleryController@getLimited');
    Route::post('/', 'GalleryController@create')->middleware(['tokenVerification', 'adminVerification']);
    Route::delete('/{id}', 'GalleryController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'GalleryController@update')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 't-shirt'], function () {
    Route::get('/', 'TShirtController@index');
    Route::get('/available/', 'TShirtController@getAvailable');
    Route::get('/{id}', 'TShirtController@get');
    Route::get('/limit/{limit}', 'TShirtController@getLimited');
    Route::post('/', 'TShirtController@create')->middleware(['tokenVerification', 'adminVerification']);
    Route::delete('/{id}', 'TShirtController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'TShirtController@update')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 'booking'], function () {
    Route::get('/', 'BookingController@index')->middleware(['tokenVerification']);
    Route::get('/group/', 'BookingController@indexGroup')->middleware(['tokenVerification']);
    Route::get('/pending/', 'BookingController@indexPending')->middleware(['tokenVerification']);
    Route::get('/group/pending/', 'BookingController@indexPendingGroup')->middleware(['tokenVerification']);
    Route::get('/{id}', 'BookingController@get')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/user/{userId}', 'BookingController@user')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/reference/{reference}', 'BookingController@getBooking');
    Route::get('/download/{reference}', 'BookingController@downloadPDF');
    Route::get('/email/{id}', 'BookingController@sendEmail')->middleware(['tokenVerification']);
    Route::get('/limit/{limit}', 'BookingController@getLimited')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/group/limit/{limit}', 'BookingController@getGroupLimited')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/admin/dashboard/', 'BookingController@getDashboard')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/', 'BookingController@create');
    Route::post('/group/', 'BookingController@createGroup');
    Route::post('/admin/', 'BookingController@adminCreate')->middleware(['tokenVerification']);
    Route::post('/admin/group', 'BookingController@adminGroupCreate')->middleware(['tokenVerification']);
    Route::delete('/{id}', 'BookingController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'BookingController@update')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/group/{id}', 'BookingController@updateGroup')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/checkin/{id}', 'BookingController@checkin')->middleware(['tokenVerification']);
});

Route::group(["prefix" => 'booking-payment'], function () {
    Route::post('/', 'BookingPaymentController@paymentReceived');
});

Route::group(["prefix" => 'user'], function () {
    Route::get('/', 'UserController@index')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/{id}', 'UserController@get')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/', 'UserController@create')->middleware(['tokenVerification', 'adminVerification']);
    Route::delete('/{id}', 'UserController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'UserController@update')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 'role'], function () {
    Route::get('/', 'RoleController@index')->middleware(['tokenVerification', 'adminVerification']);
});

Route::group(["prefix" => 'contact-us'], function () {
    Route::get('/', 'ContactUsController@index')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/{id}', 'ContactUsController@get')->middleware(['tokenVerification', 'adminVerification']);
    Route::get('/limit/{limit}', 'ContactUsController@getLimited')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/', 'ContactUsController@create');
    Route::delete('/{id}', 'ContactUsController@delete')->middleware(['tokenVerification', 'adminVerification']);
    Route::post('/update/{id}', 'ContactUsController@update')->middleware(['tokenVerification', 'adminVerification']);
});
