<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContributionModel as ContributionModel;

use App\UserStoryModel as UserStoryModel;
use App\ProjectModel as ProjectModel;


class BacklogController extends Controller
{
     public function __construct() {
      

        $this->contribution_model = new ContributionModel();

        $this->UserStoryModel = new UserStoryModel();

        $this->projects_model = new ProjectModel();


        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $uStories = Backlog::all();
    // return view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function USCreate($id)
    {
        $US = $this->UserStoryModel->GetUs($id);
        return view('backlog.createUS',array('id'=>$id,'US'=>$US));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      if( $UserStoryEdit = UserStoryModel::find($id))
        return view('backlog.EditUS',array('id'=>$id,'UserStoryEdit'=>$UserStoryEdit));
    }

     public function edit1($id) {
      if( $UserStoryEdit = UserStoryModel::find($id))
        return view('backlog.EditUS',array('id'=>$id,'UserStoryEdit'=>$UserStoryEdit,'status'=>'#US updated'));
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
            'us_description' => 'required|max:500',
            'us_prio' => 'required',
            'us_effort' => 'required',
            'id'=> 'required',
            'us'=>'required'
        ]);

       $UserStory = UserStoryModel::find($request->id);

        if($UserStory){
             $UserStory->update(['description' => $request->us_description]);
             $UserStory->update(['effort' => $request->us_effort]);
             $UserStory->update(['priority' => $request->us_prio]);
        }
             
            $Project = ProjectModel::find($UserStory->id_project);
            if ($UserStory = $this->UserStoryModel->GetUserStory($UserStory->id_project)) {
               //return view('projects.backlog', array('Project' => $Project,'UserStorys'=>$UserStory,'status'=>'#US'.$request->us.' updated'));
                return self::edit1($request->id);
                    
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


     public function AddUS(Request $request){
       $this->validate(
            $request,
            [
            'us_description' => 'required',
            'us_effort' => 'required',
            'us_prio' => 'required', 
            'id' => 'required',
                 ]
        );

    $this->UserStoryModel->description = $request->us_description;
    $this->UserStoryModel->id_project = $request->id;
    $this->UserStoryModel->effort = $request->us_effort;
    $this->UserStoryModel->priority = $request->us_prio;
      $US = $this->UserStoryModel->GetUs($request->id);
    $this->UserStoryModel->us = $US;
    $querry=$this->UserStoryModel->save();

    $Project = ProjectModel::find($request->id);
    $UserStory = $this->UserStoryModel->GetUserStory($request->id);

    if ($querry) {
            //return $EditProject;
       return redirect()->action(
    'BacklogController@USCreate', array('id' => $request->id)
);

            //return view('projects.createUS',array('id'=>$request->id,'status'=>' New User Story added','UserStorys'=>$UserStory));
        
    }else{
            //return $EditProject;
             return back()->withInput();
        }
       
     }

}
