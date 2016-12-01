<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\SprintModel as SprintModel;
use App\UserStoryModel as UserStoryModel;

use App\KanBanModel as KanBanModel;

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

        $this->kanban_model =new KanBanModel();


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
        //$ID_S = $request->id;
        $selected = $request->SelectedUserStory;
        $userstoriesID=explode(',',$selected);

      //return $userstoriesID;    
   
       //return $request->date_start.$request->date_start1;
        //dump($request);
        //$userstory= explode(',', $request->SelectedUserStory)

        $this->sprint_model->sprint_number = $request->sprintnumber;

        $this->sprint_model->start_date = $request->date_start;
        $this->sprint_model->end_date = $request->date_end;

        $this->sprint_model->id_project = $request->idP;
        $this->sprint_model->id_us = $request->SelectedUserStory;
        $this->sprint_model->selected_us=$request->SelectedUserStory;
      //  $this->projects_model->id_user = Auth::user()->id;
        $modified = $this->sprint_model->save();

 //return $this->sprint_model->start_date;
               //===================================//
         $sprintid = DB::table('sprint')->where([
                           ['sprint_number','=',$request->sprintnumber],
                           ['id_project','=',$request->idP]
                                ])
                    ->first();
          $updatesprint = SprintModel::find($sprintid->id);           
          $updatesprint->update(['start_date' => $request->date_start]);         
          //return $sprintid->id;

        foreach ($userstoriesID as $value) {
          $US = UserStoryModel::find($value);
         // $US = $this->sprint_model->GetUS($value);  //recuperer l'US correspondante
          $US->update(['id_sprint' => $sprintid->id]);
          $US->update(['sprint_number' => $request->sprintnumber]);
        }

    if($modified){
        $message="Sprint ".$request->sprintnumber." add";
     $id=$request->idP;
     $sprints = $this->sprint_model->getSprints($id);
     $kanbanTODO= $this->kanban_model->GetKanBanTODO($id,1);
     $kanbanONDOING= $this->kanban_model->GetKanBanONDOING($id,1);
      $kanbanTESTING= $this->kanban_model->GetKanBanTESTING($id,1);
      $kanbanDONE= $this->kanban_model->GetKanBanDONE($id,1);
        return view('sprints.index',
                array('id' => $id,'KanBanTODO'=>$kanbanTODO,'sprints'=>$sprints,'message'=>$message,
                    'KanBanONDOING'=>$kanbanONDOING,'kanbanTESTING'=>$kanbanTESTING,'kanbanDONE'=>$kanbanDONE)); 
    
        }
       //if($modified){ self::showSprint($request->idP); }

      // return view("sprint.index",array(''=>$request->idP));
           //==========================================//
//return $request->userstory;

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
     $sprints = $this->sprint_model->getSprints($id);
     $kanbanTODO= $this->kanban_model->GetKanBanTODO($id,1);
     $kanbanONDOING= $this->kanban_model->GetKanBanONDOING($id,1);
     $kanbanTESTING= $this->kanban_model->GetKanBanTESTING($id,1);
     $kanbanDONE= $this->kanban_model->GetKanBanDONE($id,1);
        return view('sprints.index',
                array('id' => $id,'KanBanTODO'=>$kanbanTODO,'sprints'=>$sprints,
                    'KanBanONDOING'=>$kanbanONDOING,'kanbanTESTING'=>$kanbanTESTING,'kanbanDONE'=>$kanbanDONE)); 
    }

}
