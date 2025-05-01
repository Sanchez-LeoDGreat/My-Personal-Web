<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects');
    }

    public function edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Projects/Edit', [
            'user' => $user
        ]);
    }
}
