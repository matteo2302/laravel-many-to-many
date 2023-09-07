<?php

namespace App\Http\Controllers\Admin;


use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('last_update', 'DESC')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project;
        $types = Type::select('id', 'label')->get();
        $tecnologies = Technology::select('id', 'label')->get();
        return view('admin.projects.create', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required | max:25',
            'image' => 'nullable | image',
            'date' => 'nullable | max:7',
            'last_update' => 'nullable | max:7',
            'description' => 'nullable | max:250',
            'type_id' => 'nullable | exist:types,id',
            'tecnology_id' => 'nullable | exist:tecnologies,id',
        ]);

        if (array_key_exists('image', $data)) {
            $image = Storage::putFile('project_image', $data['image']);
            $data['image'] = $image;
        };
        $project = new Project;
        $project->fill($data);
        $project->save();
        if (Arr::exists($data, 'tecnologies')) $project->tecnologies()->attach($data['tecnologies']);
        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('id', 'label')->get();
        $project_tecnology_ids = $project->tecnologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $image = Storage::putFile('project_image', $request->file('image'));
            $data['image'] = $image;
        }
        $project->update($data);
        if (!Arr::exists($data, 'tecnologies') && count($project->tecnologies)) $project->tecnologies()->detach();
        elseif (Arr::exists($data, 'tecnologies')) $project->tecnologies()->sync($data['tecnologies']);

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        if (count($project->tecnologies)) $project->tecnologies()->detach();
        return to_route('admin.projects.index');
    }
}
