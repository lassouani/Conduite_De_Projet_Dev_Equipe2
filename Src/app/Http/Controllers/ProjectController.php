<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProjectModel as ProjectModel;
use App\User as User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator as Paginator;
use App\MyPaginator as MyPaginator;
use \Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginator;
use \Illuminate\Support\Collection as Collection;
use App\Http\Controllers\TechnicalSolutionController as TechnicalSolutionController;

use App\ContributionModel as ContributionModel;

class ProjectController extends Controller {

    private $projects_model = null;

    public function __construct() {
        $this->projects_model = new ProjectModel();

        $this->contribution_model = new ContributionModel();


        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $MyProjects = [];
        $AllProjects = $this->projects_model->GetAllProject(Auth::user()->id);
        $result = $MyProjects;
        $result = $AllProjects;

        $MyProjects = $this->projects_model->GetMyProject(Auth::user()->id);
        return view('home',
                array('MyProjects' => $MyProjects, 'AllProjects' => $AllProjects));
        //return $MyProjects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $this->validate($request,
                [
            'project_name' => 'required|max:30',
            'project_description' => 'required|max:500',
            'link_to_url' => 'required|url',
            'technical_solutions' => 'max:500',
            'project_hierarchy' => 'max:300',
        ]);

        $this->projects_model->name = $request->project_name;
        $this->projects_model->description = $request->project_description;
        $this->projects_model->link = $request->link_to_url;
        $this->projects_model->id_user = Auth::user()->id;
        $this->projects_model->technical_solutions = $request->technical_solutions;
        $this->projects_model->project_hierarchy = $request->project_hierarchy;
        $modified = $this->projects_model->save();


        if ($modified) {
            return redirect('home')->with('status',
                            "Le projet " . $request->project_name . "a bien été ajouté");
        }
        return redirect('/projects/create')->with('status_not_modified',
                        "Le projet " . $request->project_name . "a bien été ajouté. "
                        . "Contactez l'admin ou recomencez le processus d'ajout dun projet");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

       
        $Project = ProjectModel::find($id);
        $User=$Project->user;
        $contribution= $this->contribution_model->TrueIfSent($id,Auth::user()->id);
        $confirm= $this->contribution_model->TrueIfConfirm($id,Auth::user()->id);
        //return $contribution;
        return view('projects/description', array('Project' => $Project,'User'=>$User ,'contribution'=>$contribution,'confirm'=>$confirm));

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
       
        if ( $EditProject = ProjectModel::find($id)) {
          //return $EditProject;
            return view('projects.editProject',array('EditProject'=>$EditProject));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
         
        $this->validate($request,
                [
            'project_name' => 'required|max:30',
            'project_description' => 'required|max:500',
            'link_to_url' => 'required|url',
            'technical_solutions' => 'max:500',
            'project_hierarchy' => 'max:300',
            'id'                =>'required',
        ]);

     $Project = ProjectModel::find($request->id);
     //$Project=ProjectModel::Where('id',$request->id)->first();
 
      if ($Project) {
     
        $Project->update(['name' => $request->project_name]);
        $Project->update(['description' => $request->project_description]);
        $Project->update(['link' => $request->link_to_url]);
        //$Project->update(['technical_solutions' => $request->technical_solutions]);
        //$Project->update(['project_hierarchy' => $request->project_hierarchy]);
      }

        $User=$Project->user;
        $contribution= $this->contribution_model->TrueIfSent($request->id,Auth::user()->id);
        $confirm= $this->contribution_model->TrueIfConfirm($request->id,Auth::user()->id);
  return view('projects/description',array('Project' => $Project,'User'=>$User ,'contribution'=>$contribution,'confirm'=>$confirm,'message'=>'the pojet was updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $var = ProjectModel::destroy($id);

        return self::index();
    }

    public function search($search) {
        $search = urldecode($search);
        // $search=urldecode($request->search);
        $MyProjects = [];
        $ResultSearcheProject = [];
        $AllProjects = $this->projects_model->GetAllProject(Auth::user()->id);
        $ResultSearcheProject = $this->projects_model->SearcheProject($search,
                Auth::user()->id);

        if ($ResultSearcheProject->total() == 0) {
            $MyProjects = $this->projects_model->GetMyProject(Auth::user()->id);
            $AllProjects = $this->projects_model->GetAllProject(Auth::user()->id);
            return view('home',
                    array('MyProjects' => $MyProjects, 'message' => 'No results found for "' . $search . '" please try with different keywords.',
                'AllProjects' => $AllProjects));
        }

        return view('home',
                array('MyProjects' => $ResultSearcheProject, 'AllProjects' => $AllProjects));
    }

    public function GetAllProject() {
        $AllProjects = [];
        $AllProjects = $this->projects_model->GetAllProject(Auth::user()->id);
        return $AllProjects;
    }

    public function searchall($search) {
        $search = urldecode($search);
        //return $search;
        $ResultSearcheProject = [];
        $ResultSearcheProject = $this->projects_model->SearchAllProject($search);

        ///return $ResultSearcheProject;
        return view('AllProject',
                array('ResultSearcheProject' => $ResultSearcheProject, 'search' => $search,
            'message' => 'No results found for "' . $search . '" please try with different keywords.'));
    }



                /*********************************************
                *                                            *
                *                                            *
                *                                            *
                *                                            *
                *                                            *
                *********************************************/

public function SendContribution($id){

//return $id;
   // $this->projects_model->SaveContributionRequest($id,Auth::user()->id);
    $this->contribution_model->id_user = Auth::user()->id;
    $this->contribution_model->id_project = $id;
    $this->contribution_model->save();

    $confirm= $this->contribution_model->TrueIfConfirm($id,Auth::user()->id);

    $Project = ProjectModel::find($id);
    $User=$Project->user;
    return view('projects/description', array('Project' => $Project,'User'=>$User,'message'=>'Contribution request is sent', 'contribution'=>'1', 'confirm'=>$confirm));

}



public function RemoveContribution($id){

 $contribution=ContributionModel::Where('id_project',$id)->where('id_user',Auth::user()->id)->first();
 $var = ContributionModel::destroy($contribution->id);
 return self::show($id);
}

public function Notification(){

        
     $querry= $this->contribution_model->GetNotificationContribution(Auth::user()->id);
     return view('projects.notification',array('notifications'=>$querry));

    }



public function ShowNotification($idProject,$idUser){

 $querry= $this->contribution_model->GetNotificationContribution(Auth::user()->id);
 $querry1= $this->contribution_model->GetNotificationDescription($idProject,$idUser);

   return view('projects.notification',array('notifications'=>$querry,'ShowNotifs' =>$querry1));
}






public function RefuseNotification($id){

 $var = ContributionModel::destroy($id);
 return self::Notification();
}



public function AcceptNotification($id){
      $contribution=ContributionModel::Where('id',$id)->first();
      if($contribution)
    $contribution->update(['confirmation' => '0']);

 return self::Notification();
    
}


                /****************************************************
                *                                                   *
                *                                                   *
                *                                                   *
                *                                                   *
                *                                                   *
                *                                                   *
                *****************************************************/


public function ShowBacklog($id){

     if ( $Project = ProjectModel::find($id)) {
          //return $EditProject;
             return view('projects.backlog',array('Project'=>$Project));
        }
   
}


}
