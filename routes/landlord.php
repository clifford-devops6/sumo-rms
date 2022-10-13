<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landlord\LandlordController;

//tenant routes

Route::group(['middleware'=>['auth:landlord','verified_landlord','role:Landlord']], function () {
    Route::resource('/landlord/portfolio', LandlordController::class);
});
