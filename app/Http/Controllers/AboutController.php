<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        return Inertia::render('About');
    }

    public function edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Pages/About', [
            'user' => $user
        ]);
    }
}
