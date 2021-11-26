<?php

use App\Http\Controllers\API\DepositController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'rooms'], function () {
        Route::get('/getRooms', [RoomController::class, 'getRooms']);
    });

    Route::group(['prefix' => 'deposits'], function () {
        Route::get('/getDeposit', [DepositController::class, 'getDeposit']);
        Route::get('/getApprovedDeposit', [DepositController::class, 'getApprovedDeposit']);
        Route::get('/getDisapprovedDeposit', [DepositController::class, 'getDisapprovedDeposit']);
        Route::post('/approvePayment', [DepositController::class, 'approvePayment']);
        Route::post('/disapprovePayment', [DepositController::class, 'disapprovePayment']);
        Route::post('/revertPayment', [DepositController::class, 'revertPayment']);
        Route::post('/revertDisapprove', [DepositController::class, 'revertDisapprove']);
    });

    Route::group(['prefix' => 'reservation'], function () {
        Route::get('getReservationUpcoming', [ReservationController::class, 'getReservationUpcoming']);
        Route::get('getReservationOngoing', [ReservationController::class, 'getReservationOngoing']);
        Route::get('getReservationExpired', [ReservationController::class, 'getReservationExpired']);
        Route::get('getReservationActive', [ReservationController::class, 'getReservationActive']);
        Route::get('getReservationThisMonth', [ReservationController::class, 'getReservationThisMonth']);
        Route::get('getMostRecentClient', [ReservationController::class, 'getMostRecentClient']);
        Route::post('deleteReservation', [ReservationController::class, 'deleteReservation']);
        Route::post('checkIn', [ReservationController::class, 'checkIn']);
        Route::post('checkOut', [ReservationController::class, 'checkOut']);
        Route::post('payCash', [ReservationController::class, 'payCash']);
        Route::post('checkExpiredReservation', [ReservationController::class, 'checkExpiredReservation']);
        Route::post('rebook', [ReservationController::class, 'rebook']);
    });

    Route::group(['prefix' => 'rooms'], function () {
        Route::post('addRooms', [RoomController::class, 'addRooms']);
        Route::post('editRooms', [RoomController::class, 'editRooms']);
        Route::post('deleteRooms', [RoomController::class, 'deleteRooms']);
        Route::post('getVacantRoomsChange', [RoomController::class, 'getVacantRoomsChange']);
    });

    Route::group(['prefix' => 'report'], function () {
        Route::post('download', [ReportController::class, 'download']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('getReceptionist', [UserController::class, 'getReceptionist']);
        Route::post('deleteUser', [UserController::class, 'deleteUser']);
        Route::post('toggleStatus', [UserController::class, 'toggleStatus']);
        Route::post('addUser', [UserController::class, 'addUser']);
    });
});
