<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\Admin\AuthenticatedAdmin;
use App\Http\Controllers\Auth\Admin\AdminPasswordReset;
use Illuminate\Support\Facades\Route;

// Auth routes. Admin Auths. Remember to add 'middleware'=>['throttle:login']
Route::group([], function(){
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
