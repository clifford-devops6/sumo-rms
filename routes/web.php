<?php

use Illuminate\Support\Facades\Route;

/*
 * Super Admin routes goes to this section
*/
use  \App\Http\Controllers\Admin\AdminController;
use  \App\Http\Controllers\Admin\AdminProfileController;


Route::get('/', function () {
    return inertia('welcome');
});

Route::group(['middleware'=>['auth']],function (){
    Route::patch('/admin/profile/password/{id}',[AdminProfileController::class, 'change'])->name('change-password');
    Route::resource('/admin/profile/settings',AdminProfileController::class);
    Route::resource('/admin/dashboard',AdminController::class);

});

//Auth routes
require __DIR__.'/auth.php';

