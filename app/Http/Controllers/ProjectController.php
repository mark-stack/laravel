<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        //Getd data
        $data = $request->all();

        //Position = previous high + 1
        $previous_high = Project::pluck('position')->max();
        $new_position = $previous_high + 1;

        //Create project
        $new_project = Project::create($data);

        //Set position number
        $new_project->position = $new_position;
        $new_project->save();

        return back()->with('success_project','Successfully created project');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $project = Project::findorfail($id);

        return view('backend.project_edit',compact('project'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $project = Project::findorfail($id);
        $project->update($data);

        return back()->with('success_project','Successfully updated project');
    }

    public function destroy($id)
    {
        $project = Project::destroy($id);

        return back()->with('success_delete','Successfully deleted project');
    }
}
