<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');
