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

    public function manage()
    {
        $user = Auth::user();
        return Inertia::render('User/Projects/Manage', [
            'user' => $user
        ]);
    }

    public function add()
    {
        $user = Auth::user();
        return Inertia::render('User/Projects/Add', [
            'user' => $user
        ]);
    }
}
