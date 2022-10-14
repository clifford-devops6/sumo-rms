<?php
use Illuminate\Support\Facades\Route;
/*
 * Super Admin routes goes to this section
*/
use  App\Http\Controllers\Admin\AdminController;
use  App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPermissionController;


Route::group(['middleware'=>['auth','verified_admin','role:Super-Admin']],function (){
    Route::patch('/admin/profile/password/{id}',[AdminProfileController::class, 'change'])->name('change-password');
    Route::resource('/admin/profile/settings',AdminProfileController::class);
    Route::resource('/admin/dashboard',AdminController::class);
    Route::resource('/admin/roles-and-permissions/roles',AdminRoleController::class);
    Route::resource('/admin/roles-and-permissions/permission',AdminPermissionController::class);

});
