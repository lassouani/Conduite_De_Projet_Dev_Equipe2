<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\SprintModel as SprintModel;
use App\UserStoryModel as UserStoryModel;
use App\ProjectModel as ProjectModel;
use Illuminate\Support\Facades\DB;

class SprintController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() {
      
        $this->sprint_model = new SprintModel();


        $this->UserStoryModel = new UserStoryModel();

        $this->projects_model = new ProjectModel();


    }
    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $querry = DB::table('userstory')->where([
                    ['id_project', '=', $id],
                ])
                ->orderBy('us', 'asc')
                ->get();
        $sprint = DB::table('sprint')->where([
                    ['id_project', '=', $id],
                ])
                ->get();        
        return view('sprints.create',array('projectID'=>$id,'UserStorys'=>$querry,'sprint'=>$sprint->count()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $this->validate(
                $request,
               [
            'date_start' => 'required|',
            'date_end' => 'required|',
                ]
        );

        $this->sprint_model->sprint_number = $request->sprintnumber;
        $this->sprint_model->start_date = $request->date_start;
        $this->sprint_model->end_date = $request->date_end;
        $this->sprint_model->id_project = $request->idP;
        //$this->sprint_model->id_us = $request->SelectedUserStory;
      //  $this->projects_model->id_user = Auth::user()->id;
        $modified = $this->sprint_model->save();

return $request->userstory;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {


       
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
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
   

    public function showSprint($id) {
        //$id == id du projet
        $sprints = self::getSprints($id);
        $all_tasks = [];
        foreach ($sprints as $key => $value) {
            $sprint = UserStoryModel::where('id', $key)->get();
            $all_tasks[$sprint[0]->id] = $sprint[0]->tasks;
        }
        return view('sprints.index',
                array('id' => $id, 'sprints' => $sprints, 'all_tasks' => $all_tasks));
    }

}
