<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SprintModel as SprintModel;
use App\ProjectModel as ProjectModel;


use Illuminate\Support\Facades\DB;
  

class KanBanController extends Controller
{


   public function __construct() {
$this->sprint_model = new SprintModel();
$this->projects_model = new ProjectModel();
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backlog.kanBan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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



    public function chart($id){

        $sprints = $this->sprint_model->getSprints($id);
        $project= $this->projects_model->GetProject($id);
        $userstory = DB::table('userstory')->where([
                    ['id_project', '=', $id]])
                    ->orderBy('sprint_number','asc')
                  ->get();
        return view("burndownChart.BurnDownChart",array('project'=>$project,'sprints'=>$sprints,'userstorys'=>$userstory));
    }
}
