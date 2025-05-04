<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send-email', [ContactController::class, 'send_email'])->name('contact.send-email');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/pages/home/edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::put('/user/pages/home/update', [HomeController::class, 'update'])->name('home.update');

    Route::get('/user/pages/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/user/pages/about/update', [AboutController::class, 'update'])->name('about.update');

    Route::get('/user/projects', [ProjectsController::class, 'edit'])->name('projects.edit');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
