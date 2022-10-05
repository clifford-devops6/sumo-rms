<?php
use Illuminate\Support\Facades\Route;
use  \App\Http\Controllers\Auth\AdminAuthController;
use  \App\Http\Controllers\Auth\AuthenticatedAdmin;

// Auth routes. Customized to fit the application needs
Route::group(['middleware'=>['throttle:login']], function(){
    Route::get('/admin/auth/login',[AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('admin/auth/authenticate',[AdminAuthController::class, 'authenticate']);
    Route::get('/admin/auth/register',[AdminAuthController::class, 'register']);
    Route::post('/admin/auth/create',[AdminAuthController::class, 'create']);

});

Route::group(['middleware'=>['auth']], function (){
    Route::post('/admin/auth/logout',[AuthenticatedAdmin::class, 'destroy']);
});
