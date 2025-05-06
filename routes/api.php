<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-page-content', [ApiController::class, 'get_page_content'])->name('api.get-page-content');
Route::post('/fetch-projects', [ProjectsController::class, 'fetch'])->name('api.fetch-projects');
