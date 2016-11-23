<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContributionModel as ContributionModel;
use App\UserStoryModel as UserStoryModel;
use App\ProjectModel as ProjectModel;

//===========================
use App\TaskModel as TaskModel;
use Illuminate\Support\Facades\DB;
//================================

class BacklogController extends Controller {

    public function __construct() {
    
    //==============================
        $this->task_model = new TaskModel();
    //==================================

        $this->contribution_model = new ContributionModel();

        $this->UserStoryModel = new UserStoryModel();

        $this->projects_model = new ProjectModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $uStories = Backlog::all();
        // return view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function USCreate($id) {
        $US = $this->UserStoryModel->GetUs($id);
        return view('backlog.createUS', array('id' => $id, 'US' => $US));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if ($UserStoryEdit = UserStoryModel::find($id))
            return view('backlog.EditUS',
                    array('id' => $id, 'UserStoryEdit' => $UserStoryEdit));
//return $UserStoryEdit;
    }

    public function edit1($id) {
        if ($UserStoryEdit = UserStoryModel::find($id))
            return view('backlog.EditUS',
                    array('id' => $id, 'UserStoryEdit' => $UserStoryEdit, 'status' => '#US updated'));
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
            'id' => 'required',
            'us' => 'required'
        ]);

        $UserStory = UserStoryModel::find($request->id);

        if ($UserStory) {
            $UserStory->update(['description' => $request->us_description]);
            $UserStory->update(['effort' => $request->us_effort]);
            $UserStory->update(['priority' => $request->us_prio]);
            $UserStory->update(['tracability' => $request->tracability]);
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
    public function destroy($id) {
        //
    }

    public function AddUS(Request $request) {
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
        $querry = $this->UserStoryModel->save();

        $Project = ProjectModel::find($request->id);
        $UserStory = $this->UserStoryModel->GetUserStory($request->id);

        if ($querry) {
            //return $EditProject;
            return redirect()->action(
                            'BacklogController@USCreate',
                            array('id' => $request->id)
            );

            //return view('projects.createUS',array('id'=>$request->id,'status'=>' New User Story added','UserStorys'=>$UserStory));
        } else {
            //return $EditProject;
            return back()->withInput();
        }
    }

//==============================================add task===============================================

//sofiane
public function Showsofiane($id){

    $querry = DB::table('taches')->where([
                    ['id_us', '=', $id],
                ])
                ->get();
     $UserStory = UserStoryModel::find($id);


    return view('backlog.show',array('UserStory' =>$UserStory,'task'=>$querry->count()+1));
}


public function Addtasksofiane(Request $request){

   $this->validate(
                $request,
                [
            'task_description' => 'required|max:200',
            //'task_state' => 'required',
           // 'assigned_developer' => 'required',
            'effort' => 'required',
            'priority' => 'required',
                ]
        );

   $this->task_model->description = $request->task_description;
        $this->task_model->id_us = $request->usid;
        $this->task_model->us = $request->us1;
        $this->task_model->effort = $request->effort;
        $this->task_model->priority = $request->priority;
       // $this->task_model->id_developer = $request->assigned_developer;
        $querry = $this->task_model->save();

        if ($querry) {
            //return $EditProject;
            return redirect()->action(
                            'BacklogController@Showsofiane',
                            array('UserStory' => $request->usid)
            );

            //return view('projects.createUS',array('id'=>$request->id,'status'=>' New User Story added','UserStorys'=>$UserStory));
        } else {
            //return $EditProject;
            return back()->withInput();
        }

}

}
