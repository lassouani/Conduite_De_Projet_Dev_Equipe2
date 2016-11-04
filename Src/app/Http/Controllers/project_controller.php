<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
use App\Http\Requests;

class project_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
        $this->project_model = new ProjectModel();
    }

// je suis pas sur comment si vous avez fais les tbles de base des données ou pas 
   /*
    public function project(){
    	return view('project_description', array('project' => Auth::user()) );
    }
    public function show($id){

    	$Project=$this->project_model->GetProject($id);
    	$User=$this->project_model->user;
         return view('project_description', array('Project' => $Project,'User' => $User));

       
    }
    */
    public function show($id){
        $Project = Projects::find($id);
        if (!$id){
            abort(404);
            return view('project_description')->with('Project',$Project);

        }
    }

}
