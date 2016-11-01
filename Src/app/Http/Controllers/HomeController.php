<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 
	  private $Project_Model=null;
	 
    public function __construct()
    {
        $this->middleware('auth');
		$this-> Project_Model = new ProjectModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
		$MyProjects=[];
		$MyProjects=$this->Project_Model->GetMyProject(Auth::user()->id);
        return view('home', ['MyProjects' => $MyProjects]);
        //return $MyProjects;
    }




public function search($search)
    {    
       // return urldecode($search);
       // $search=urldecode($request->search);
        $errors=[];
     $errors = ['error' => 'No results found, please try with different keywords.'];
        $MyProjects=[];
        $ResultSearcheProject=[];
            $ResultSearcheProject=$this->Project_Model->SearcheProject($search,Auth::user()->id);

            if ($ResultSearcheProject->total()  == 0) {
                $MyProjects=$this->Project_Model->GetMyProject(Auth::user()->id);
                return view('home', ['MyProjects' => $MyProjects], ['message' => 'No results found for "'.$search.'" please try with different keywords.']);
                
            }

                 return view('home', ['MyProjects' => $ResultSearcheProject]);
        
        

}        

}
