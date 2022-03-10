"<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('/payments')->group(function (){
    Route::post('/pay',[App\Http\Controllers\PaymentController::class, 'pay'])->name('pay');
    Route::get('/approval',[App\Http\Controllers\PaymentController::class, 'pay'])->name('approval');
    Route::get('/cancelled',[App\Http\Controllers\PaymentController::class, 'pay'])->name('cancelled');
});
