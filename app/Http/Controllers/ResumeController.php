<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ResumeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('User/Resume/Index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Resume/Edit', [
            'user' => $user
        ]);
    }

    public function fetch()
    {
        $path = 'data/Resume.json';
        $storage = Storage::disk('public');
        if (!$storage->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found!'
            ], 404);
        }
        $resume = $storage->get($path);
        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully',
            'resume' => json_decode($resume)
        ]);
    }
}
