<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ReviewsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'nullable|string',
            'rating' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        $key = "project_reviewed_$request->project_id-" . $request->ip();
        if (!Cache::has($key)) {
            Cache::put($key, true, now()->addWeek());
            Review::create([
                'project_id' => $request->project_id,
                'name' => Str::trim($request->name),
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);
        } else {
            return back()->withErrors(['review' => 'You have already submitted a review for this project.']);
        }

        return back()->with('success', 'Successfully posted your review!');
    }
}
