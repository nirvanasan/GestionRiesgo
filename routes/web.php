<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('home');
});

Route::get('registro', function () {
    return view('registro');
});

Route::get('recuperar', function () {
    return view('recuperar');
});

Route::get('main', function () {
    return view('main');
});

