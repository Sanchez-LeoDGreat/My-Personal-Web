<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

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
}
