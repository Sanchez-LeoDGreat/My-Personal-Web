<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadablesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send-email', [ContactController::class, 'send_email'])->name('contact.send-email');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/projects/view/{project_id}/{downloadable_id?}', [ProjectsController::class, 'view'])->name('projects.view');
Route::get('/projects/reviews/{project_id}', [ReviewsController::class, 'index'])->name('projects.reviews');
Route::post('/projects/reviews/store', [ReviewsController::class, 'store'])->name('projects.reviews.store');
Route::post('/projects/prepare-download', [DownloadablesController::class, 'prepare_download'])->name('projects.prepare-download');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/pages/home/edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::put('/user/pages/home/update', [HomeController::class, 'update'])->name('home.update');

    Route::get('/user/pages/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/user/pages/about/update', [AboutController::class, 'update'])->name('about.update');

    Route::get('/user/projects/manage', [ProjectsController::class, 'manage'])->name('projects.manage');
    Route::get('user/projects/add', [ProjectsController::class, 'add'])->name('projects.add');
    Route::post('/user/projects/store', [ProjectsController::class, 'store'])->name('projects.store');
    Route::get('user/projects/edit/{id}', [ProjectsController::class, 'edit'])->name('projects.edit');
    Route::post('/user/projects/update', [ProjectsController::class, 'update'])->name('projects.update');
    Route::delete('/user/projects/delete/{id}', [ProjectsController::class, 'delete'])->name('projects.delete');
    Route::get('/user/projects/add-version', [DownloadablesController::class, 'add'])->name('projects.add-version');
    Route::post('/user/projects/store-version', [DownloadablesController::class, 'store'])->name('projects.store-version');
    Route::get('/user/projects/edit-version', [DownloadablesController::class, 'edit'])->name('projects.edit-version');
    Route::post('/user/projects/update-version', [DownloadablesController::class, 'update'])->name('projects.update-version');
    Route::delete('/user/projects/delete-version', [DownloadablesController::class, 'delete'])->name('projects.delete-version');

    Route::get('/user/resume', [ResumeController::class, 'index'])->name('user.resume');
    Route::post('/user/resume/set', [ResumeController::class, 'set'])->name('user.resume.set');
    Route::get('/user/resume/edit', [ResumeController::class, 'edit'])->name('user.resume.edit');
    Route::post('/user/resume/edit/save', [ResumeController::class, 'save'])->name('user.resume.edit.save');
    Route::get('/resume/download', [ResumeController::class, 'downloadPDF'])->name('resume.download');

    Route::get('/user/reports', [ReportController::class, 'index'])->name('user.reports');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
