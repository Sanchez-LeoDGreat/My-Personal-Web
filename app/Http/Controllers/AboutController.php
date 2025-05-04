<?php

namespace App\Http\Controllers;

use App\Models\Page;
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

    public function update(Request $request)
    {
        $request->validate([
            'about_me' => 'required|string',
            'experience' => 'required|array',
        ]);

        $content = json_encode([
            'about_me' => $request->about_me,
            'exp_timeline' => $request->experience,
        ]);

        $page = Page::firstWhere('name', 'about');
        if (!$page) {
            return back()->withErrors(['page' => 'Page not found.']);
        }
        $page->update([
            'content' => $content,
        ]);
        return back()->with('success', "About Page's content updated successfully.");
    }
}
