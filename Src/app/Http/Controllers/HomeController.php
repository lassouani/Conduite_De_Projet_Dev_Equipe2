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
        $AllProjects=$this->Project_Model->GetAllProject();
        $result=$MyProjects;
         $result=$AllProjects;

		$MyProjects=$this->Project_Model->GetMyProject(Auth::user()->id);
        return view('home',  array('MyProjects' => $MyProjects,'AllProjects' => $AllProjects) );
        //return $MyProjects;
    }




public function search($search)
    {    
       $search= urldecode($search);
       // $search=urldecode($request->search);
        $MyProjects=[];
        $ResultSearcheProject=[];
            $AllProjects=$this->Project_Model->GetAllProject();
            $ResultSearcheProject=$this->Project_Model->SearcheProject($search,Auth::user()->id);

            if ($ResultSearcheProject->total()  == 0) {
                $MyProjects=$this->Project_Model->GetMyProject(Auth::user()->id);
                  $AllProjects=$this->Project_Model->GetAllProject();
                return view('home', array('MyProjects' => $MyProjects, 'message' => 'No results found for "'.$search.'" please try with different keywords.', 'AllProjects' => $AllProjects) );
                
            }

                 return view('home', array('MyProjects' => $ResultSearcheProject,'AllProjects' => $AllProjects));
        
        

}        

public function GetAllProject(){
    $AllProjects=[];
    $AllProjects=$this->Project_Model->GetAllProject();
    return $AllProjects;
}


public function searchall($search){
    $search= urldecode($search);
    //return $search;
      $ResultSearcheProject=[];
       $ResultSearcheProject=$this->Project_Model->SearchAllProject($search);

     ///return $ResultSearcheProject;
       return view('AllProject',array('ResultSearcheProject'=>$ResultSearcheProject,'search'=>$search, 'message' => 'No results found for "'.$search.'" please try with different keywords.'));

}



}
