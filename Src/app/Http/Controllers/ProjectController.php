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
use App\TechnicalSolutionModel as TechnicalSolutionModel;
use App\ProjectHierarchyModel as ProjectHierarchyModel;

class ProjectController extends Controller {

    private $projects_model = null;
    private $technical_solutions_model = null;
    private $project_hierarchy_model = null;

    public function __construct() {
        $this->projects_model = new ProjectModel();
        $this->technical_solutions_model = new TechnicalSolutionModel();
        $this->project_hierarchy_model = new ProjectHierarchyModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('projects.index');
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
        $modified = $this->projects_model->save();

        $this->technical_solutions_model->description = $request->technical_solutions;
        $this->technical_solutions_model->project_id = $this->projects_model->id;
        $this->technical_solutions_model->save();

        $this->project_hierarchy_model->description = $request->project_hierarchy;
        $this->project_hierarchy_model->project_id = $this->projects_model->id;
        $this->project_hierarchy_model->save();

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
        //
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
        
    }

}
