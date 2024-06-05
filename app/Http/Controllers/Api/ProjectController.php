<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
        $title = $request->input('title');
        $typeId = $request->input('type_id');
        $technologyId = $request->input('technology_id');

        $query = Project::with(['type', 'technologies'])
            ->where('title', 'like', '%' . $title . '%');

        if ($typeId) {
            $query->where('type_id', $typeId);
        }

        if ($technologyId) {
            $query->whereHas('technologies', function ($q) use ($technologyId) {
                $q->where('technologies.id', $technologyId);
            });
        }

        $projects = $query->paginate(9);

        $projects->appends($request->all());

        return response()->json($projects);
    }

    public function projectShow($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if ($project->image) {
            $project->image = Storage::url($project->image);
        } else {
            $project->image = Storage::url('uploads/no-image.png');
            $project->original_image_name = 'no-image';
        }

        return response()->json($project);
    }
}
