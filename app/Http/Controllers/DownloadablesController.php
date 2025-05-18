<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DownloadablesController extends Controller
{
    public function add_version(Request $request)
    {
        $user = Auth::user();
        $project = Project::with([
            'downloadables',
            'reviews' => fn($q) => $q->select('id', 'project_id', 'rating'),
        ])->firstWhere('id', $request->project_id);
        if (!$project) {
            return to_route('projects.manage');
        }
        return Inertia::render('User/Projects/Versions/Add', [
            'user' => $user,
            'project' => $project,
        ]);
    }
}
