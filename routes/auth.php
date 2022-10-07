<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\Admin\AuthenticatedAdmin;
use App\Http\Controllers\Auth\Admin\AdminPasswordReset;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Manager\ManagerAuthController;
use App\Http\Controllers\Auth\Manager\AuthenticatedManager;

// Auth routes. Admin Auths. Remember to add 'middleware'=>['throttle:login']
Route::group(['middleware'=>['guest:manager']], function(){
    Route::get('/admin/auth/login',[AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('admin/auth/authenticate',[AdminAuthController::class, 'authenticate']);
    Route::get('/admin/auth/register',[AdminAuthController::class, 'register']);
    Route::post('/admin/auth/create',[AdminAuthController::class, 'create']);
    Route::get('/admin/auth/password-reset',[AdminPasswordReset::class, 'reset']);
    Route::post('/admin/auth/password-store',[AdminPasswordReset::class, 'store']);
    Route::get('/admin/auth/reset-password/{token}', [AdminPasswordReset::class, 'create'])->name('password.reset');
    Route::post('/admin/auth/update-password', [AdminPasswordReset::class, 'update'])->name('password.update');


});



Route::group(['middleware'=>['auth']], function (){
    Route::post('/admin/auth/logout',[AuthenticatedAdmin::class, 'destroy']);
});

// Auth routes. Manager Auths. Remember to add 'middleware'=>['throttle:login']
Route::group([], function (){
    Route::get('/manager/auth/register',[ManagerAuthController::class, 'register']);
    Route::post('/manager/auth/create',[ManagerAuthController::class, 'create']);
    Route::get('/manager/auth/login',[ManagerAuthController::class, 'login'])->name('manager.login');
    Route::post('manager/auth/authenticate',[ManagerAuthController::class, 'authenticate']);
});

Route::group(['middleware'=>['auth:manager']], function (){
    Route::post('/manager/auth/logout',[AuthenticatedManager::class, 'destroy']);
});
