<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Backlog as Backlog;
use App\ContributionModel as ContributionModel;

class BacklogController extends Controller
{
     public function __construct() {
        $this->backlog = new Backlog();

        $this->contribution_model = new ContributionModel();


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
    public function edit($id) {
       
        if ( $EditBacklog = Backlog::find($id)) {
            return view('backlog',array('EditBacklog'=>$EditBacklog));
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
            'us_description' => 'required|max:500',
            'us_prio' => 'required',
            'us_effort' => 'required',
            'id' =>'required',
        ]);
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
            'us_prio' => 'required',      ]
        );

       
     }

}
