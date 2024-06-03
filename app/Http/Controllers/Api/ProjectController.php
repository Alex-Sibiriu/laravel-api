<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::with('type', 'technologies')->paginate(9);

        return response()->json($projects);
    }

    public function search($title)
    {
        $projects = Project::with('type', 'technologies')->where('title', 'like', '%' . $title . '%')->paginate(9);

        return response()->json($projects);
    }
}
