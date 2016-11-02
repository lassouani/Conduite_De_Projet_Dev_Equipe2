<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class project_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

// je suis pas sur comment si vous avez fais les tbles de base des données ou pas 
    public function project(){
    	return view('project_description', array('project' => Auth::user()) );
    }

}
