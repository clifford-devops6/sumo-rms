<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landlord\LandlordController;

//tenant routes

Route::group(['middleware'=>['verified_landlord','auth:landlord','role:Landlord']], function () {
    Route::resource('/landlord/portfolio', LandlordController::class);
});
