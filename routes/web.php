<?php

use Illuminate\Support\Facades\Route;

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

$authRoutes = [
    'namespace' => 'App\Http\Controllers',
];

$adminRoutes = [
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => 'role:admin',
    'prefix' => 'admin'
];

Route::get('/', function ()    {
    return view('welcome');
})->name('home');

Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('AuthUserLogout');

Route::group($authRoutes, function(){
    Route::get('/auth/login', function () { return view('auth.login'); });

    Route::get('/auth/login/client', [\App\Http\Controllers\LoginController::class, 'login'])->name('AuthUser');
    Route::get('/auth/register', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('AuthRegister');
    Route::get('/auth/register/seller', [\App\Http\Controllers\RegistrationController::class, 'registerSeller'])->name('RegisterSeller');
    Route::get('/auth/register/customer', [\App\Http\Controllers\RegistrationController::class, 'registerCustomer'])->name('RegisterCustomer');
});
Route::group($adminRoutes, function() {
    Route::get('/', function() {
        return view('admin');
    })->name('AdminHome');
    Route::resource('clients','AdminClientsListController');
    Route::resource('sellers','AdminSellersListController');
});
