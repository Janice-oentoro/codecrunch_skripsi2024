<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function getTopics($progName)
    {
        // Fetch topics where the topic name contains the programming name
        $topics = Topic::where('topic_name', 'like', '%' . $progName . '%')->get();

        return response()->json($topics);
    }
}