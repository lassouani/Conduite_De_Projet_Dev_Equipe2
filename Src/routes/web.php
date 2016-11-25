<?php

use Illuminate\Support\Facades\Input;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', 'Visitor\ProjectController@index');

//Authentification
Auth::routes();


//Email Confirmation
Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');

//Facebook login
Route::get('auth/facebook', 'FacebookController@redirectToProvider');
Route::get('auth/facebook/callback', 'FacebookController@handleProviderCallback');

//GitHub login
Route::get('auth/github', 'GithubController@redirectToProvider');
Route::get('auth/github/callback', 'GithubController@handleProviderCallback');

Route::post('public/projects/description/{id}', 'Visitor\ProjectController@show');

//Baklog Project
Route::get("projects/backlog/{id}", 'ProjectController@ShowBacklog');

Route::get("projects/sprints/{id}", 'SprintController@showSprint');

//Search public project
Route::get('search/public/project',
        function() {
    $search = urlencode(e(Input::get('search')));
    if ($search) {
        $route = "search/public/project/$search";
        return redirect($route);
    } else {
        return redirect('home');
    }
});

Route::get("search/public/project/{search}",
        'Visitor\ProjectController@searchPublicProject');


Route::group(['middleware' => 'auth'],
        function () {

    //Profile User
    Route::get('profile', 'UserController@profile');
    Route::post('profile', 'UserController@update_avatar');

    //Project Action
    Route::post('/projects/register', 'ProjectController@store');
    Route::get('/projects/create', 'ProjectController@create');
    Route::post('/projects/destroy/{id}', 'ProjectController@destroy');
    Route::post('projects/description/{id}', 'ProjectController@show');

    Route::get("project/edit/{id}", 'ProjectController@edit');
    Route::post("projects/update", 'ProjectController@update');

    Route::get('/projects/description',
            function() {
        return view('projects/description');
    });
    Route::get('all/projects', 'ProjectController@GetAllProject');
    Route::get('projects/contribution',
            'ProjectController@getContributedProjects');

    Route::get('search/redirect',
            function() {
        $search = urlencode(e(Input::get('search')));
        if ($search) {
            $route = "search/Myproject/$search";
            return redirect($route);
        } else {
            return redirect('home');
        }
    });

    Route::get("search/Myproject/{search}", 'ProjectController@search');

    //**************************
    Route::get('search/redirect/all',
            function() {
        $search = urlencode(e(Input::get('search')));
        if ($search) {
            $route = "search/project/all/$search";
            return redirect($route);
        } else {
            return redirect('home');
        }
    });

    Route::get("search/project/all/{search}", 'ProjectController@searchall');

    //*******************************************
    Route::get('search/redirect/contribution',
            function() {
        $search = urlencode(e(Input::get('search')));
        if ($search) {
            $route = "search/project/contribution/$search";
            return redirect($route);
        } else {
            return redirect('home');
        }
    });

    Route::get("search/project/contribution/{search}",
            'ContributionController@searchContributedProject');
    Route::get('search/redirect/contribution',
            function() {
        $search = urlencode(e(Input::get('search')));
        if ($search) {
            $route = "search/project/contribution/$search";
            return redirect($route);
        } else {
            return redirect('home');
        }
    });

    Route::get("search/project/contribution/{search}",
            'ContributionController@searchContributedProject');


    //Notification
    Route::get("notification/description/{idProject}/{idUser}",
            'ProjectController@ShowNotification');
    Route::get("notification/destroy/{id}",
            'ProjectController@RefuseNotification');
    Route::get("notification/accept/{id}",
            'ProjectController@AcceptNotification');

    //Home
    Route::get('/home', 'ProjectController@index');

   //Contribution Request
    Route::get("contribution/send/{id}", 'ProjectController@SendContribution');
    Route::get("contribution/remove/{id}",
            'ProjectController@RemoveContribution');
    Route::get("notifications/project", 'ProjectController@Notification');

    //Backlog
    Route::get('/backlog/add_us',
            function() {
        return view('backlog/add_us');
    });
    Route::get('/backlog/description',
            function() {
        return view('backlog/description');
    });
    Route::get("backlig/edit/{id}", 'BacklogController@edit');

    Route::post("backlog/update", 'BacklogController@update');

    Route::post("backlog/add/us", 'BacklogController@AddUS');


//Sprint
Route::get('/sprints/create/{id}', 'SprintController@create');
Route::post('/sprints/register', 'SprintController@store');






    Route::get('/us/create/{id}', 'BacklogController@USCreate');

    Route::get('us/edit/{id}', 'BacklogController@edit');

    Route::post("/us/update", 'BacklogController@update');

    //Tasks
    Route::get("task/create/{id}", 'TaskController@create');
    Route::post("task/register/{id}", 'TaskController@store');


    //KanBan
    Route::get("kanban","KanBanController@index");
});


Route::get("search/project/contribution/{search}",
        'ContributionController@searchContributedProject');




//Contribution Request
Route::get("contribution/send/{id}", 'ProjectController@SendContribution');
Route::get("contribution/remove/{id}", 'ProjectController@RemoveContribution');
Route::get("notifications/project", 'ProjectController@Notification');


//Notification
Route::get("notification/description/{idProject}/{idUser}",
        'ProjectController@ShowNotification');
Route::get("notification/destroy/{id}", 'ProjectController@RefuseNotification');
Route::get("notification/accept/{id}", 'ProjectController@AcceptNotification');


//Baklog Project
Route::get("projects/backlog/{id}", 'ProjectController@ShowBacklog');



//Tasks
Route::get("task/create/{id}", 'TaskController@create');
Route::post("task/register/{id}", 'TaskController@store');



//Sprint
Route::get('/sprints/create', 'SprintController@create');
Route::post('/sprints/', 'SprintController@store');


//sofiane
Route::get("show/{id}",'BacklogController@Showsofiane');
Route::post("/task/add",'BacklogController@Addtasksofiane');

Route::get("task/{id}",'TaskController@show');



// If View Don't Exist
Route::get('{view}',
        function ($view) {
    if (view()->exists($view)) {
        return view($view);
    }

    return app()->abort(404, 'Page not found!');
});