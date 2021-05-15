<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//middlewares can be directly implemented here instead of the controllers
//? here we use the post in logout as we are submitting a form to logout
//?for normal user
Route::post('/logout',[LoginController::class,'userLogOut'])->name('user.logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');
//?for admin we create a group of routes
Route::prefix('admin')->group(function(){
    //?routes for admin login
    Route::get('/login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login',[AdminLoginController::class,'login'])->name('admin.login.submit');
    Route::post('/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
    // we use /admin below other /admin/login and /admin/register as they depend on admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    //* password reset routes
    //1 to get the request form
    Route::get('/password/reset',[AdminForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
    //2 To submit email
    Route::post('/password/email',[AdminForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
    //3 to get the token form
    Route::get('/password/reset/{token}',[AdminResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
    //4 to reset and submit new password
    Route::post('/password/reset',[AdminResetPasswordController::class,'reset']);
});