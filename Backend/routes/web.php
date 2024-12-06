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

Route::get('dofa', function () {
    return view('dofa');
});

Route::get('eleccion', function () {
    return view('eleccion');
});

Route::get('proceso', function () {
    return view('proceso');
});

Route::get('VerDofa', function () {
    return view('VerDofa');
});