<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('characters', App\Http\Controllers\CharacterController::class);
//Route::get('/characters', [App\Http\Controllers\CharacterController::class, 'index'])->name('characters');
//Route::get('/characters/{id}', [App\Http\Controllers\CharacterController::class, 'show'])->name('characters.show');
Route::get('/characters/{id}/edit', [App\Http\Controllers\CharacterController::class, 'edit'])->name('characters.edit');
