<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $projects = project::all();

        return view('backend.admin_dashboard',compact('projects'));
    }

    public function createProject(Request $request){

        $data = $request->all();

        Project::create($data);

        return back()->with('success_create','Successfully created project');
    }

    public function projectPositionUp($id){

        //Get project
        $project = Project::findorfail($id);

        //Current position
        $current_position = $project->position;

        //Proposed position
        $proposed_position = $current_position - 1;

        //Can only lower number if proposed is above zero
        if($proposed_position > 0){

            //Look for an existing project with this position number, then swap
            $swapped_project = Project::where('position',$proposed_position)->first();

            if($swapped_project){
                //This project
                $project->position = $proposed_position;
                $project->save();

                //Swapped project
                $swapped_project->position = $current_position;
                $swapped_project->save();
            }
        }

        return back();
    }

    public function projectPositionDown($id){

        //Get project
        $project = Project::findorfail($id);

        //Current position
        $current_position = $project->position;

        //Proposed position
        $proposed_position = $current_position + 1;

        //Look for an existing project with this position number, then swap
        $swapped_project = Project::where('position',$proposed_position)->first();

        if($swapped_project){
            //This project
            $project->position = $proposed_position;
            $project->save();

            //Swapped project
            $swapped_project->position = $current_position;
            $swapped_project->save();
        }
        
        return back();
    }
}
