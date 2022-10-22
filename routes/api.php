<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantApiController;
use App\Http\Controllers\Api\TenantGuestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'/sumorems/v1'],function (){
   Route::post('/register', [TenantApiController::class,'register']);
   Route::post('/update/{id}', [TenantApiController::class,'update']);
   Route::post('/login', [TenantApiController::class,'login']);
   Route::post('/request/resendOTP/{id}', [TenantApiController::class,'verification']);//resend verification code
    Route::post('/request/verifyUser/{id}', [TenantApiController::class,'verifyUser']);
});

//Tenant Guest and appointment booking Apis
Route::group(['prefix'=>'/sumorems/v1/guest'],function (){
    Route::get('/show/{id}',[TenantGuestController::class, 'showGuest']);
    Route::post('/create/{id}',[TenantGuestController::class, 'createGuest']);
    Route::patch('/update/{id}/{guest}',[TenantGuestController::class, 'updateGuest']);
    Route::delete('/destroy/{id}/{guest}',[TenantGuestController::class, 'destroyGuest']);
    Route::post('/appointment/create/{id}',[TenantGuestController::class, 'createAppointment']);
    Route::patch('/appointment/update/{id}',[TenantGuestController::class, 'updateAppointment']);
    Route::get('/appointment/show/{id}',[TenantGuestController::class, 'showAppointment']);
    Route::delete('/appointment/destroy/{id}',[TenantGuestController::class, 'destroyAppointment']);
});

