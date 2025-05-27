<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-page-content', [ApiController::class, 'get_page_content'])->name('api.get-page-content');
Route::post('/fetch-projects', [ProjectsController::class, 'fetch'])->name('api.fetch-projects');
Route::post('/fetch-reviews', [ReviewsController::class, 'fetch'])->name('api.fetch-reviews');
Route::post('/fetch-config', [ApiController::class, 'fetch_config'])->name('api.fetch-config');
Route::post('/fetch-resume', [ResumeController::class, 'fetch'])->name('api.fetch-resume');
