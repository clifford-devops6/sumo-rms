<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\TenantController;
//tenant routes

Route::group(['middleware'=>['auth:tenant','role:Tenant','verified_tenant']], function (){
    Route::resource('/tenant/resident', TenantController::class);
});
