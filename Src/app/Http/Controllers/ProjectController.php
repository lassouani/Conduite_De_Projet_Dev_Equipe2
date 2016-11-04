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


        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $MyProjects = [];
        $AllProjects = $this->projects_model->GetAllProject();
        $result = $MyProjects;
        $result = $AllProjects;

        $MyProjects = $this->projects_model->GetMyProject(Auth::user()->id);
        return view('home',
                array('MyProjects' => $MyProjects, 'AllProjects' => $AllProjects));
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

        
        $Project=$this->projects_model->GetProject($id);

        $User=$this->projects_model->user;
         return view('projects/description', array('Project' => $Project));

       
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
        $var = ProjectModel::destroy($id);

        return self::index();
    }

    public function search($search) {
        $search = urldecode($search);
        // $search=urldecode($request->search);
        $MyProjects = [];
        $ResultSearcheProject = [];
        $AllProjects = $this->projects_model->GetAllProject();
        $ResultSearcheProject = $this->projects_model->SearcheProject($search,
                Auth::user()->id);

        if ($ResultSearcheProject->total() == 0) {
            $MyProjects = $this->projects_model->GetMyProject(Auth::user()->id);
            $AllProjects = $this->projects_model->GetAllProject();
            return view('home',
                    array('MyProjects' => $MyProjects, 'message' => 'No results found for "' . $search . '" please try with different keywords.',
                'AllProjects' => $AllProjects));
        }

        return view('home',
                array('MyProjects' => $ResultSearcheProject, 'AllProjects' => $AllProjects));
    }

    public function GetAllProject() {
        $AllProjects = [];
        $AllProjects = $this->projects_model->GetAllProject();
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

}