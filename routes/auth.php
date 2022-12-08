<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\Admin\AdminPasswordReset;
use App\Http\Controllers\Auth\Admin\AuthenticatedAdmin;
use App\Http\Controllers\Auth\Caretaker\AuthenticatedCaretaker;
use App\Http\Controllers\Auth\Caretaker\CaretakerAuthController;
use App\Http\Controllers\Auth\Caretaker\CaretakerPasswordReset;
use App\Http\Controllers\Auth\Landlord\AuthenticatedLandlord;
use App\Http\Controllers\Auth\Landlord\LandlordAuthController;
use App\Http\Controllers\Auth\Landlord\LandlordPasswordReset;
use App\Http\Controllers\Auth\Manager\AuthenticatedManager;
use App\Http\Controllers\Auth\Manager\ManagerAuthController;
use App\Http\Controllers\Auth\Manager\ManagerPasswordReset;
use App\Http\Controllers\Auth\Tenant\AuthenticatedTenant;
use App\Http\Controllers\Auth\Tenant\TenantAuthController;
use App\Http\Controllers\Auth\Tenant\TenantPasswordReset;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Auth routes. Admin Auths. Remember to add 'middleware'=>['throttle:login']
Route::group(['middleware'=>['throttle:login','guest:tenant','guest:caretaker','guest:web', 'guest:manager','guest:landlord']], function(){
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
    Route::get('/admin/auth/verify',[AuthenticatedAdmin::class, 'verify'])->name('admin.verify');
    Route::post('/admin/auth/verified',[AuthenticatedAdmin::class, 'checkVerification'])->name('admin.verified');
    Route::post('/admin/auth/resend-link',[AuthenticatedAdmin::class, 'resendVerification'])->middleware('throttle:6,1');
});

// Auth routes. Manager Auths. Remember to add 'middleware'=>['throttle:login']
Route::group(['middleware'=>['throttle:login','guest:tenant','guest:caretaker','guest:web', 'guest:manager','guest:landlord']], function (){
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
    Route::get('/manager/auth/verify',[AuthenticatedManager::class, 'verify'])->name('manager.verify');
    Route::post('/manager/auth/verified',[AuthenticatedManager::class, 'checkVerification'])->name('manager.verified');
    Route::post('/manager/auth/resend-link',[AuthenticatedManager::class, 'resendVerification'])->middleware('throttle:6,1');
});

// Auth routes. Unit Manager Auths. Remember to add 'middleware'=>['throttle:login']

Route::group(['middleware'=>['guest:tenant','guest:caretaker','guest:web', 'guest:manager','guest:landlord']],function (){
    Route::get('/caretaker/auth/register',[CaretakerAuthController::class, 'register']);
    Route::get('/caretaker/auth/login',[CaretakerAuthController::class, 'login'])->name('caretaker.login');
    Route::post('/caretaker/auth/create',[CaretakerAuthController::class, 'create']);
    Route::post('/caretaker/auth/authenticate',[CaretakerAuthController::class, 'authenticate']);

    //caretaker password reset routes
    Route::get('/caretaker/auth/forgot-password',[CaretakerPasswordReset::class, 'reset']);
    Route::post('/caretaker/auth/password-store',[CaretakerPasswordReset::class, 'store']);
    Route::get('/caretaker/auth/reset-password', [CaretakerPasswordReset::class, 'create'])->name('caretaker.reset');
    Route::post('/caretaker/auth/update-password', [CaretakerPasswordReset::class, 'update']);
});
//
Route::group(['middleware'=>['auth:caretaker']], function (){
    //logout caretaker
    Route::post('/caretaker/auth/logout',[AuthenticatedCaretaker::class, 'destroy']);
    Route::get('/caretaker/auth/verify',[AuthenticatedCaretaker::class, 'verify'])->name('caretaker.verify');
    Route::post('/caretaker/auth/verified',[AuthenticatedCaretaker::class, 'checkVerification'])->name('caretaker.verified');
    Route::post('/caretaker/auth/resend-link',[AuthenticatedCaretaker::class, 'resendVerification'])->middleware('throttle:6,1');
});

//Tenant auth routes
Route::group(['middleware'=>['guest:tenant','guest:caretaker','guest:web', 'guest:manager','guest:landlord']], function (){
    Route::get('/tenant/auth/register',[TenantAuthController::class, 'register']);
    Route::get('/tenant/auth/login',[TenantAuthController::class, 'login'])->name('tenant.login');
    Route::post('/tenant/auth/create',[TenantAuthController::class, 'create']);
    Route::post('/tenant/auth/authenticate',[TenantAuthController::class, 'authenticate']);

    //caretaker password reset routes
    Route::get('/tenant/auth/forgot-password',[TenantPasswordReset::class, 'reset']);
    Route::post('/tenant/auth/password-store',[TenantPasswordReset::class, 'store']);
    Route::get('/tenant/auth/reset-password/{toke}', [TenantPasswordReset::class, 'create'])->name('tenant.reset');
    Route::post('/tenant/auth/update-password', [TenantPasswordReset::class, 'update']);
});

Route::group(['middleware'=>['auth:tenant']], function (){
    //logout tenant
    Route::post('/tenant/auth/logout',[AuthenticatedTenant::class, 'destroy']);
    Route::get('/tenant/auth/verify',[AuthenticatedTenant::class, 'verify'])->name('tenant.verify');
    Route::post('/tenant/auth/verified',[AuthenticatedTenant::class, 'checkVerification'])->name('tenant.verified');
    Route::post('/tenant/auth/resend-link',[AuthenticatedTenant::class, 'resendVerification'])->middleware('throttle:6,1');

});

//Landlord auth routes
Route::group(['middleware'=>['guest:tenant','guest:caretaker','guest:web', 'guest:manager','guest:landlord']], function (){
    Route::get('/landlord/auth/register',[LandlordAuthController::class, 'register']);
    Route::get('/landlord/auth/login',[LandlordAuthController::class, 'login'])->name('landlord.login');
    Route::post('/landlord/auth/create',[LandlordAuthController::class, 'create']);
    Route::post('/landlord/auth/authenticate',[LandlordAuthController::class, 'authenticate']);

    //landlord password reset routes
    Route::get('/landlord/auth/forgot-password',[LandlordPasswordReset::class, 'reset']);
    Route::post('/landlord/auth/password-store',[LandlordPasswordReset::class, 'store']);
    Route::get('/landlord/auth/reset-password/{token}', [LandlordPasswordReset::class, 'create'])->name('landlord.reset');
    Route::post('/landlord/auth/update-password', [LandlordPasswordReset::class, 'update']);
});

Route::group(['middleware'=>['auth:landlord']], function (){
    //logout landlord
    Route::post('/landlord/auth/logout',[AuthenticatedLandlord::class, 'destroy']);
    Route::get('/landlord/auth/verify',[AuthenticatedLandlord::class, 'verify'])->name('landlord.verify');
    Route::post('/landlord/auth/verified',[AuthenticatedLandlord::class, 'checkVerification'])->name('landlord.verified');
    Route::post('/landlord/auth/resend-link',[AuthenticatedLandlord::class, 'resendVerification'])->middleware('throttle:6,1');
});


//Authentication routes



