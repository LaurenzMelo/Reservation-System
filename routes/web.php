<?php

use App\Http\Controllers\API\DepositController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\WebsiteController;
use App\Http\Controllers\HomeController;
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

Route::get('', function () {
    return view('pages/website/index');
});

//Website
Route::group(['prefix' => '/'], function () {
    Route::get('index', [WebsiteController::class, 'index'])->name('website.index');
    Route::get('rooms-list', [WebsiteController::class, 'rooms'])->name('website.rooms');
    Route::get('facilities', [WebsiteController::class, 'facilities'])->name('website.facilities');
    Route::get('contact-us', [WebsiteController::class, 'contact_us'])->name('website.contact-us');
    Route::get('booking', [WebsiteController::class, 'booking'])->name('website.booking');
    Route::get('booking-details', [WebsiteController::class, 'details'])->name('website.booking-details');

    Route::get('getRoomsWebsite', [RoomController::class, 'getRoomsWebsite']);

    Route::group(['prefix' => 'booking/'], function () {
       Route::post('getVacantRooms', [RoomController::class, 'getVacantRooms']);
       Route::post('createReservation', [ReservationController::class, 'createReservation']);
       Route::post('checkReservation', [ReservationController::class, 'checkReservation']);
        Route::post('savePayment', [ReservationController::class, 'savePayment']);
    });
});

Auth::routes();


Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'rooms'], function () {
        Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
    });

    Route::group(['prefix' => 'deposits'], function () {
        Route::get('/', [DepositController::class, 'index'])->name('deposit.index');
    });

    Route::group(['prefix' => 'reservation'], function () {
        Route::get('/', [ReservationController::class, 'index'])->name('reservation.index');
    });
});
