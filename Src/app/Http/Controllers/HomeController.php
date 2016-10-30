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
    {    $recherche="ntsearche";
		$MyProjects=[];
		$MyProjects=$this->Project_Model->GetMyProject(Auth::user()->id);
        return view('home', ['MyProjects' => $MyProjects]);
        //return $MyProjects;
    }




public function searche(Request $request)
    {
        if ($request->has('search')) {
            $ResultSearcheProject=$this->Project_Model->SearcheProject($request->search,Auth::user()->id);
            return view('home', ['MyProjects' => $ResultSearcheProject]);
        }

}        

}
