<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\TechnologyRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $exists = Type::where('name', $val_data['name'])->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'Il tipo ' . $val_data['name'] . ' é già presente');
        } else {
            $val_data['slug'] = Helper::createSlug($val_data['name'], Type::class);
            $type = new Type;
            $type->fill($val_data);
            $type->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Tipo ' . $type->name . ' aggiunto con successo');;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $projects = $type->projects;
        $num_projects = count($projects);

        return view('admin.types.show', compact('projects', 'num_projects', 'type'));
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
    public function update(TechnologyRequest $request, Type $type)
    {
        $val_data = $request->all();

        $exists = Type::where('name', $val_data['name'])->first();

        if ($exists) {
            return redirect()->route('admin.technologies.index')->with('error', 'Il tipo ' . $val_data['name'] . ' é già presente');
        } else {
            if ($val_data['name'] === $type->name) {
                $val_data['slug'] = $type->slug;
            } else {
                $val_data['slug'] = Helper::createSlug($val_data['name'], Type::class);
            }

            $type->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Tipo ' . $type->name . ' modificato con successo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Tipo ' . $type->name . ' eliminato con successo');
    }
}
