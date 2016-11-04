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
        $this->project_model = new ProjectModel();
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

        
        $Project=$this->project_model->GetProject($id);

        $User=$this->project_model->user;
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
        /*  $project_to_delete = $this->projects_model->$id;
          $projects_of_this_user = User::find(Auth::user()->id)->projects;
          foreach ($projects_of_this_user as $key => $value) {
          if (condition) {
          # code...
          }
          $project_to_delete->
          dump($key + ','+$value);
          }

          $project_to_delete->delete(); */
    }

    public function contributedProjects() {
        $user = User::find(Auth::user()->id);
//        dump($user);
//        $data = $user->except('fillable');
        $i = 0;
        $contr_pro = [];
        //  dump($user->contributedProjects);
        foreach ($user->contributedProjects as $contributed_pro) {
            $contr_pro = array_merge($contr_pro,
                    self::cleanContributedProjectsData($contributed_pro, $i));
            $i++;
        }

        $searchResults = [
            'item1',
            'item2',
            'item3',
            'item4',
            'item5',
            'item6',
            'item7',
            'item8',
            'item9',
            'item10'
        ];
        //dump($contr_pro);
        //$contr_pro->paginate(5);
        // return view('projects.index', ['contr_pro' => $contr_pro]);
        // 
//        $paginator = new Paginator(array_slice($contr_pro, 0, count($contr_pro),
//                        true), 5,
//                \Illuminate\Pagination\Paginator::resolveCurrentPage(),
//                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]);
//        
//        $paginator->setPath('http://localhost/cdp_dev/Src/public/projects/contribution');
        /* $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
          array_slice($searchResults, 0, count($searchResults)),
          count($searchResults), //a fake range of total items, you can use range(1, count($collection))
          4, //items per page
          \Illuminate\Pagination\Paginator::resolveCurrentPage(), //resolve the path
          ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
          ); */
//        $items = collect($contr_pro);
//        $page = \Request::get('page', 1);
//        $perPage = 5;
//
//
//        $paginator = new LengthAwarePaginator(
//                $items->forPage($page, $perPage), $items->count(), $perPage,
//                \Illuminate\Pagination\Paginator::resolveCurrentPage(),
//                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
//        );
//        
//        
        // dump($searchResults);
        //Get current page form url e.g. &page=6
        $currentPage = MyPaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($searchResults);
        //   dump($collection);
        //Define how many items we want to be visible in each page
        $perPage = 4;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage,
                        $perPage)->all();
        //   dump($currentPageSearchResults);
        //Create our paginator and pass it to the view
        $paginatedSearchResults = new MyPaginator($currentPageSearchResults,
                count($collection), $perPage,
                \Illuminate\Pagination\Paginator::resolveCurrentPage(),
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]);
        $myarray = $paginatedSearchResults->getItems();
        dump($myarray);
        //return view('search', ['results' => $paginatedSearchResults]); 
        return view('projects.contributedProjects',
                ['contr_pro' => $paginatedSearchResults]);
    }

    public function cleanContributedProjectsData($contributed_pro, $i) {
        $clean_data[$i]['name'] = $contributed_pro['name'];
        $clean_data[$i]['description'] = $contributed_pro['description'];
        $clean_data[$i]['link'] = $contributed_pro['link'];
        return $clean_data;
    }

}
