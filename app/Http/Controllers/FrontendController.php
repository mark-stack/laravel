<?php

namespace App\Http\Controllers;

use App\Models\Project;

class FrontendController extends Controller
{

    public function landing($tag = null)
    {

        if($tag){

            //Loop through all projects, explode the tags, and find matches
            $all_projects = Project::where('status',true)->get();
            $id_array = [];
            foreach($all_projects as $project){
                //Tags array all lowercase
                $tags = explode(',',$project->category);
                $tags = array_map('strtolower', $tags);

                //Tag: lowercase and remove hyphens
                $tag = str_replace('-',' ',$tag);
                $tag = strtolower($tag);

                //Search array
                if (in_array($tag, $tags)){
                    array_push($id_array,$project->id); 
                }
            }
            
            //If 'PHP' or 'API', make all uppercase
            if($tag == 'api' || $tag == 'php'){
                $tag = strtoupper($tag);
            }
            $projects = Project::orderBy('position')->find($id_array);
        }
        else{
            $projects = Project::where('status',true)->orderBy('position')->get();
        }
        
        return view('frontend.landing',compact('projects','tag'));
    }

    public function socialLoginRememberProject($name,$social){

        //Replace hyphens
        $name = str_replace('-',' ',$name);
        
        //Stripe
        if($name == 'stripe integration'){
            session(['project' => 'stripe']);
        }

        //Calendar
        if($name == 'calendar'){
            
            session(['project' => 'calendar']);
        }

        //GraphQL
        if($name == 'graphql'){
            session(['project' => 'graphql']);
        }

        //Mobile verification
        if($name == 'mobile verification'){
            session(['project' => 'mobile']);
        }

        //Socials
        if($name == 'socials login'){
            session(['project' => 'socials']);
        }

        if($social == 'google'){
            return redirect('/auth/redirect/google');
        }
        elseif($social == 'linkedin'){
            return redirect('/auth/redirect/linkedin');
        }
    }

}
