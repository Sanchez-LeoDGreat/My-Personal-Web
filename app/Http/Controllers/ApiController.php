<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function get_page_content(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $page = Page::where($validated)->first();
        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => "Failed! Unable to find page's name.",
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved requested page!',
            'content' => json_decode($page->content),
        ]);
    }

    public function fetch_config()
    {
        $storage = Storage::disk('public');
        $path = 'data/Config.json';
        if (!$storage->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'Config file not found!'
            ], 404);
        }
        $config = json_decode($storage->get($path));
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved config!',
            'config' => $config
        ]);
    }
}
