<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->paginate(9);

        return response()->json($projects);
    }

    public function technologies()
    {
        $technologies = Technology::all();

        return response()->json($technologies);
    }

    public function types()
    {
        $types = Type::all();

        return response()->json($types);
    }

    public function searchProjects(Request $request)
    {
        $title = $request['title'];
        $type = $request['type'];

        if (!is_null($type)) {
            $projects = Project::with('type', 'technologies')->where('type_id', $type)
                ->where('title', 'like', '%' . $title . '%')
                ->paginate(9);
        } else {
            $projects = Project::with('type', 'technologies')
                ->where('title', 'like', '%' . $title . '%')
                ->paginate(9);
        }

        $projects->appends(['title' => $title, 'type' => $type]);

        return response()->json($projects);
    }

    public function projectShow($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if ($project->image) {
            $project->image = asset('storage/' . $project->image);
        } else {
            $project->image = asset('storage/uploads/no-image.png');
            $project->original_image_name = 'no-image';
        }

        return response()->json($project);
    }
}
