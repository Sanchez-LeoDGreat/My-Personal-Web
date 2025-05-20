<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;
use PHPInsight\Sentiment;

class ReviewsController extends Controller
{
    public function index($project_id)
    {
        $project = Project::find($project_id);
        if (!$project) {
            return to_route('projects');
        }
        return Inertia::render('Projects/AllReviews', [
            'project' => $project
        ]);
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'project_id' => 'required|numeric|exists:projects,id',
            'filter' => 'required|string',
        ]);

        $review = Review::where('project_id', $request->project_id);
        $result = [];
        $filter = $request->filter;

        if (preg_match('/^\dstar[s]?$/', $filter)) {
            // Filter like 1star, 2stars, etc.
            $rating = (int) $filter;
            $result = $review->where('rating', $rating)->latest()->paginate(15);
        } else {
            $result = $review->latest()->paginate(15);
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved reviews!',
            'reviews' => $result,
        ]);
    }

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
