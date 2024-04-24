<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('characters', App\Http\Controllers\CharacterController::class);
Route::resource('contests', App\Http\Controllers\ContestController::class);
Route::resource('places', App\Http\Controllers\PlaceController::class);
Route::get('/contests/create/{id}', [App\Http\Controllers\ContestController::class, 'create']);
Route::get('/contests/{id}/{attackType}', [App\Http\Controllers\ContestController::class, 'attack'])->name('contests.attack');
