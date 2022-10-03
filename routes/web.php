<?php

use Illuminate\Support\Facades\Route;

/*
 * Super Admin routes goes to this section
*/
use  \App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return inertia('welcome');
});

Route::group([],function (){
    Route::resource('/admin/dashboard',AdminController::class);
});
