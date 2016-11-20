<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\ProjectModel as ProjectModel;

class ProjectController extends Controller {

    private $project_model = null;

    public function __construct() {
        $this->project_model = new ProjectModel();
    }

    public function searchPublicProject($search) {
        $search = urldecode($search);
        $searchResult = $this->project_model->searchPublicProject($search);

        return view('visitor.projects.resultSearch',
                array('Projects' => $searchResult, 'search' => $search));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $public_projects = DB::table('projects')
                ->where('public', true)
                ->paginate(10);

        return view('welcome', array('public_projects' => $public_projects));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $Project = ProjectModel::find($id);

        return view('visitor/projects/description', array('Project' => $Project));
    }

}
