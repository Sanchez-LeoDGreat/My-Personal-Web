<?php

namespace App\Http\Controllers;

use App\Models\Downloadable;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class DownloadablesController extends Controller
{
    public function add(Request $request)
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

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'downloadable_file' => 'required|file',
            'what_is_new' => 'nullable|string',
            'version' => [
                'required',
                'string',
                Rule::unique('downloadables')->where(function ($q) use ($request) {
                    return $q->where('project_id', $request->project_id);
                }),
            ],
        ]);

        $download_path = $request->file('downloadable_file')->store('projects/downloadables', 'public');
        if (!$download_path) {
            return back()->withErrors(['downloadable_file', 'Failed to upload file!']);
        }

        Downloadable::create([
            'project_id' => $request->project_id,
            'version' => $request->version,
            'what_is_new' => $request->what_is_new,
            'download_path' => $download_path
        ]);

        return to_route('projects.edit', $request->project_id)->with('success', 'New version of project is addedd successfully!');
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $downloadable = Downloadable::with(['project', 'project.reviews'])
            ->firstWhere('id', $request->version_id);

        return Inertia::render('User/Projects/Versions/Edit', [
            'user' => $user,
            'downloadable' => $downloadable
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'downloadable_id' => 'required|exists:downloadables,id',
            'downloadable_file' => 'nullable|file',
            'what_is_new' => 'nullable|string',
            'version' => [
                'required',
                'string',
                Rule::unique('downloadables')
                    ->ignore($request->downloadable_id)
                    ->where(function ($q) use ($request) {
                        return $q->where('project_id', $request->project_id);
                    }),
            ],
        ]);

        $downloadable = Downloadable::firstWhere('id', $request->downloadable_id);
        if (!$downloadable) {
            return back()->withErrors(['project_version' => 'Project version not found.']);
        }

        $newData = [
            'version' => $request->version,
            'what_is_new' => $request->what_is_new,
        ];

        if ($request->file('downloadable_file')) {
            $download_path = $request->file('downloadable_file')->store('projects/downloadables', 'public');

            if ($downloadable->download_path && Storage::disk('public')->exists($downloadable->download_path)) {
                Storage::disk('public')->delete($downloadable->download_path);
            }

            $newData['download_path'] = $download_path;
        }

        $downloadable->update($newData);

        return back()->with('success', "Project's version has been updated.");
    }
}
