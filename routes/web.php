<?php

use Illuminate\Support\Facades\Route;



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

//manager routes
Route::group(['middleware'=>['auth:manager','verified_manager', 'role:Property-Manager']], function (){
    Route::resource('/manager/home', ManagerController::class);
});

//caretaker routes
Route::group(['middleware'=>['auth:caretaker', 'role:Caretaker','verified_caretaker']], function (){
    Route::resource('/caretaker/public', CaretakerController::class);
});

//Auth routes
require __DIR__.'/auth.php';
require __DIR__.'/tenant.php';
require __DIR__.'/landlord.php';
require __DIR__.'/admin.php';
