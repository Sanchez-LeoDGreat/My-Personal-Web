<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_timeline(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $timeline = Timeline::where($validated)->first();
        if (!$timeline) {
            return response()->json([
                'success' => false,
                'message' => "Failed! Unable to find timeline's name.",
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved requested timeline!',
            'timeline' => json_decode($timeline->timeline),
        ]);
    }
}
