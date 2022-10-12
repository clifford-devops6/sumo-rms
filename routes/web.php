<?php

use Illuminate\Support\Facades\Route;

/*
 * Super Admin routes goes to this section
*/
use  \App\Http\Controllers\Admin\AdminController;
use  \App\Http\Controllers\Admin\AdminProfileController;

/*
 * Manager routes goes to this section
*/

use  \App\Http\Controllers\Manager\ManagerController;

/*
 * Caretaker routes goes to this section
*/

use  App\Http\Controllers\Caretaker\CaretakerController;

Route::get('/', function () {
    return inertia('welcome');
});
//Admin routes
Route::group(['middleware'=>['auth','verified_admin']],function (){
    Route::patch('/admin/profile/password/{id}',[AdminProfileController::class, 'change'])->name('change-password');
    Route::resource('/admin/profile/settings',AdminProfileController::class);
    Route::resource('/admin/dashboard',AdminController::class);

});
//manager routes
Route::group(['middleware'=>['auth:manager']], function (){
    Route::resource('/manager/home', ManagerController::class);
});

//caretaker routes
Route::group(['middleware'=>['auth:caretaker','verified_caretaker']], function (){
    Route::resource('/caretaker/public', CaretakerController::class);
});

//Auth routes
require __DIR__.'/auth.php';
require __DIR__.'/tenant.php';
require __DIR__.'/landlord.php';
