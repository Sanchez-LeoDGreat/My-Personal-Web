<?php

namespace App\Http\Controllers;

use App\Models\Downloadable;
use App\Models\Project;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'user' => $user,
        ]);
    }

    public function add()
    {
        $user = Auth::user();
        return Inertia::render('User/Projects/Add', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|max:2048',
            'title' => 'required|string|unique:projects,name',
            'about' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'downloadable' => 'boolean',
            'previews' => 'nullable|array',
            'previews.*' => 'file',
        ]);

        if ($request->downloadable) {
            $request->validate([
                'downloadable_version' => 'required|string',
                'downloadable_file' => 'required|file',
            ]);
        }

        $previews = [];
        $iconPath = $request->file('icon')->store('projects/icons', 'public');
        if ($request->has('previews')) {
            foreach ($request->file('previews') as $preview) {
                $previews[] = $preview->store('projects/previews', 'public');
            }
        }

        $project = Project::create([
            'name' => $request->title,
            'icon_path' => $iconPath,
            'previews' => json_encode($previews),
            'about' => $request->about,
            'summary' => $request->summary,
            'description' => $request->description,
            'downloadable' => $request->downloadable
        ]);

        if ($request->downloadable) {
            $download_path = $request->file('downloadable_file')->store('projects/downloadables', 'public');
            Downloadable::create([
                'project_id' => $project->id,
                'version' => $request->downloadable_version,
                'download_path' => $download_path,
            ]);
        }

        return to_route('projects.manage')->with('success', 'Successfully added the new project!');
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $project = Project::where('id', $id)->with(['downloadables'])->first();
        return Inertia::render('User/Projects/Edit', [
            'user' => $user,
            'project' => $project,
        ]);
    }

    public function view()
    {
        //
    }

    public function delete($id)
    {
        try {
            $project = Project::find($id);
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found!',
                ]);
            }
            $storage = Storage::disk('public');
            Review::where('project_id', $id)->delete();
            $downloadables = Downloadable::where('project_id', $id)->get();
            if ($downloadables) {
                foreach ($downloadables as $downloadable) {
                    $storage->delete($downloadable->download_path);
                    $downloadable->delete();
                }
            }
            $storage->delete($project->icon_path);
            $previews = json_decode($project->previews) ?: [];
            foreach ($previews as $preview) {
                $storage->delete($preview);
            }
            $project->delete();
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'sort_by' => 'nullable|string',
        ]);

        $query = Project::with(['reviews', 'downloadables'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });

        switch ($request->sort_by) {
            case 'alphabetical':
                $query->orderBy('name');
                break;
            case 'views':
                $query->orderBy('view_count', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
        }

        $projects = $query->paginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched projects!',
            'projects' => $projects
        ]);
    }
}
