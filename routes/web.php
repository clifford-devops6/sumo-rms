<?php

use Illuminate\Support\Facades\Route;

/*
 * Super Admin routes goes to this section
*/
use  \App\Http\Controllers\Admin\AdminController;
use  \App\Http\Controllers\Admin\AdminProfileController;

/*
 * Super Admin routes goes to this section
*/

use  \App\Http\Controllers\Manager\ManagerController;

Route::get('/', function () {
    return inertia('welcome');
});
//Admin routes
Route::group(['middleware'=>['auth']],function (){
    Route::patch('/admin/profile/password/{id}',[AdminProfileController::class, 'change'])->name('change-password');
    Route::resource('/admin/profile/settings',AdminProfileController::class);
    Route::resource('/admin/dashboard',AdminController::class);

});

Route::group(['middleware'=>['auth:manager']], function (){
    Route::resource('/manager/home', ManagerController::class);
});

//Auth routes
require __DIR__.'/auth.php';

