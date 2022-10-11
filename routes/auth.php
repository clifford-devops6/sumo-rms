<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\Admin\AdminPasswordReset;
use App\Http\Controllers\Auth\Admin\AuthenticatedAdmin;
use App\Http\Controllers\Auth\Caretaker\CaretakerAuthController;
use App\Http\Controllers\Auth\Manager\AuthenticatedManager;
use App\Http\Controllers\Auth\Manager\ManagerAuthController;
use App\Http\Controllers\Auth\Manager\ManagerPasswordReset;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Caretaker\AuthenticatedCaretaker;
use App\Http\Controllers\Auth\Caretaker\CaretakerPasswordReset;
use App\Http\Controllers\Auth\Tenant\TenantAuthController;
use App\Http\Controllers\Auth\Tenant\AuthenticatedTenant;
use App\Http\Controllers\Auth\Tenant\TenantPasswordReset;
use Inertia\Inertia;

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
Route::group(['middleware'=>['throttle:login','guest:tenant','guest:caretaker','guest:web', 'guest:manager']], function (){
    Route::get('/manager/auth/register',[ManagerAuthController::class, 'register']);
    Route::post('/manager/auth/create',[ManagerAuthController::class, 'create']);
    Route::get('/manager/auth/login',[ManagerAuthController::class, 'login'])->name('manager.login');
    Route::post('manager/auth/authenticate',[ManagerAuthController::class, 'authenticate']);
    //password reset & update roots
    Route::get('/manager/auth/forgot-password',[ManagerPasswordReset::class, 'reset']);
    Route::post('/manager/auth/password-store',[ManagerPasswordReset::class, 'store']);
    Route::get('/manager/auth/reset-password/{token}', [ManagerPasswordReset::class, 'create'])->name('manager.reset');
    Route::post('/manager/auth/update-password', [ManagerPasswordReset::class, 'update']);
});

Route::group(['middleware'=>['auth:manager']], function (){
    Route::post('/manager/auth/logout',[AuthenticatedManager::class, 'destroy']);
});

// Auth routes. Unit Manager Auths. Remember to add 'middleware'=>['throttle:login']

Route::group(['middleware'=>['guest:tenant','guest:caretaker','guest:web', 'guest:manager']],function (){
    Route::get('/caretaker/auth/register',[CaretakerAuthController::class, 'register']);
    Route::get('/caretaker/auth/login',[CaretakerAuthController::class, 'login'])->name('caretaker.login');
    Route::post('/caretaker/auth/create',[CaretakerAuthController::class, 'create']);
    Route::post('/caretaker/auth/authenticate',[CaretakerAuthController::class, 'authenticate']);

    //caretaker password reset routes
    Route::get('/caretaker/auth/forgot-password',[CaretakerPasswordReset::class, 'reset']);
    Route::post('/caretaker/auth/password-store',[CaretakerPasswordReset::class, 'store']);
    Route::get('/caretaker/auth/reset-password/{token}', [CaretakerPasswordReset::class, 'create'])->name('caretaker.reset');
    Route::post('/caretaker/auth/update-password', [CaretakerPasswordReset::class, 'update']);
});
//
Route::group(['middleware'=>['auth:caretaker']], function (){
    //logout caretaker
    Route::post('/caretaker/auth/logout',[AuthenticatedCaretaker::class, 'destroy']);
});

//Tenant auth routes
Route::group(['middleware'=>['guest:tenant','guest:caretaker','guest:web', 'guest:manager']], function (){
    Route::get('/tenant/auth/register',[TenantAuthController::class, 'register']);
    Route::get('/tenant/auth/login',[TenantAuthController::class, 'login'])->name('tenant.login');
    Route::post('/tenant/auth/create',[TenantAuthController::class, 'create']);
    Route::post('/tenant/auth/authenticate',[TenantAuthController::class, 'authenticate']);

    //caretaker password reset routes
    Route::get('/tenant/auth/forgot-password',[TenantPasswordReset::class, 'reset']);
    Route::post('/tenant/auth/password-store',[TenantPasswordReset::class, 'store']);
    Route::get('/tenant/auth/reset-password/{token}', [TenantPasswordReset::class, 'create'])->name('tenant.reset');
    Route::post('/tenant/auth/update-password', [TenantPasswordReset::class, 'update']);
});

Route::group(['middleware'=>['auth:tenant']], function (){
    //logout tenant
    Route::post('/tenant/auth/logout',[AuthenticatedTenant::class, 'destroy']);
});



//email verification routes
Route::get('/verify-email', function () {
    return Inertia::render('verify-email');
})->middleware('auth')->name('verification.notice');
