<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Pages/Home', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'skills' => 'required|array',
            'introduction' => 'required|string',
        ]);

        $content = json_encode([
            'my_skills' => $request->skills,
            'introduction' => $request->introduction,
        ]);

        $page = Page::firstWhere('name', 'home');
        if (!$page) {
            return back()->withErrors(['page' => 'Page not found.']);
        }
        $page->update([
            'content' => $content,
        ]);
        return back()->with('success', "Home Page's content updated successfully.");
    }
}
