<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'home'])->name('guest.home');
Route::get('/about', [GuestController::class, 'about'])->name('guest.about');
Route::get('/contact', [GuestController::class, 'contact'])->name('guest.contact');
Route::get('/projects', [GuestController::class, 'projects'])->name('guest.projects');
