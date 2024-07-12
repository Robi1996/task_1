<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\ValidUrl;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('account.login');

Route::post('/authenticate',[LoginController::class,'autherticate'])->name('accunt.autherticate');
Route::get('/User/Registration',[LoginController::class,'register'])->name('accunt.register');
Route::post('/User/ProcessRegister',[LoginController::class,'ProcessRegister'])->name('accunt.ProcessRegister');


Route::get('/User/dashboard',[DashboardController::class,'dashboard'])->name('accunt.dashboard')->middleware(ValidUrl::class);
Route::get('/logout',[LoginController::class,'logout'])->name('accunt.logout');