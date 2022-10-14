<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantApiController;
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

Route::group([], function (){
   Route::post('/sumorems/v1/register', [TenantApiController::class,'register']);
   Route::post('/sumorems/v1/update/{id}', [TenantApiController::class,'update']);
   Route::post('/sumorems/v1/login', [TenantApiController::class,'login']);
   Route::post('/sumorems/v1/request/verification/{id}', [TenantApiController::class,'verification']);
});
