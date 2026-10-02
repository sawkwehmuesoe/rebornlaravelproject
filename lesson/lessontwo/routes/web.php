<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\StatusesController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboards',[DashboardsController::class,'index'])->name('home');



Route::resource('/statuses',StatusesController::class);

