<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use App\Models\Project;
use App\Functions\Helper;
use App\Http\Requests\TechnologyRequest;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tecnologies = Technology::orderByDesc('id')->get();
        $types = Type::orderByDesc('id')->get();

        return view('admin.technologies.index', compact('tecnologies', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnologyRequest $request)
    {
        $val_data = $request->all();

        $exists = Technology::where('name', $val_data['name'])->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'La tecnologia ' . $val_data['name'] . ' é già presente');
        } else {
            $val_data['slug'] = Helper::createSlug($val_data['name'], Technology::class);
            $technology = new Technology;
            $technology->fill($val_data);

            $technology->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia ' . $technology->name . ' aggiunta con successo');;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        $projects = $technology->projects;
        $num_projects = count($projects);

        return view('admin.technologies.show', compact('projects', 'num_projects', 'technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->all();

        $exists = Technology::where('name', $val_data['name'])->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'La tecnologia ' . $val_data['name'] . ' é già presente');
        } else {

            if ($val_data['name'] === $technology->name) {
                $val_data['slug'] = $technology->slug;
            } else {
                $val_data['slug'] = Helper::createSlug($val_data['name'], Technology::class);
            }

            $technology->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia ' . $technology->name . ' modificata con successo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia ' . $technology->name . ' eliminata con successo');
    }
}
