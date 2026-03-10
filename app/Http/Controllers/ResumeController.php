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
        $config = Storage::disk('public')->get('data/Config.json');
        return Inertia::render('User/Resume/Index', [
            'user' => $user,
            'config' => json_decode($config),
        ]);
    }

    public function set(Request $request)
    {
        $request->validate([
            'downloadable_resume' => 'required|string'
        ]);
        $storage = Storage::disk('public');
        $path = 'data/Config.json';
        if (!$storage->exists($path)) {
            return back()->withErrors(['config' => 'Config file not found!']);
        }
        $config = json_decode($storage->get($path));
        $config->resume->downloadable = $request->downloadable_resume;
        if ($request->downloadable_resume == 'uploaded') {
            if ($config->resume->uploaded_path == "") {
                $request->validate([
                    'uploaded_resume' => 'required|mimes:pdf|max:2048',
                ]);
            }

            if ($request->file('uploaded_resume')) {
                if ($config->resume->uploaded_path != "") {
                    $storage->delete($config->resume->uploaded_path);
                }
                $resume_path = $request->file('uploaded_resume')->store('resume', 'public');
                $config->resume->uploaded_path = $resume_path;
            }
        }
        $storage->put($path, json_encode($config, JSON_PRETTY_PRINT));
        return back()->with('success', 'Downloadable resume set successfully!');
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

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'image' => 'nullable',
            'about_me' => 'required|min:3',
            'contact' => 'required',
            'email' => 'required|email',
            'address' => 'required|min:3',
            'categories' => 'required|array',
            'categories.*.title' => 'required|string',
            'categories.*.content' => 'required|string'
        ]);

        $path = 'data/Resume.json';
        $storage = Storage::disk('public');

        $storage->put(
            $path,
            json_encode([
                'name' => $request->name,
                'image' => $request->image,
                'about_me' => $request->about_me,
                'contact' => $request->contact,
                'email' => $request->email,
                'address' => $request->address,
                'categories' => $request->categories,
            ], JSON_PRETTY_PRINT)
        );

        return to_route('user.resume')->with('success', 'Resume edited successfully!');
    }
}
