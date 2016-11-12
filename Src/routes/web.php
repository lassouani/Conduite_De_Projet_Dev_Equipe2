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

Route::get('/', function () {
    return view('welcome');
});

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



//Profile User
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');


//Home
Route::get('/home', 'ProjectController@index');



//Project Action
Route::post('/projects/register', 'ProjectController@store');
Route::get('/projects/create', 'ProjectController@create');
Route::post('/projects/destroy/{id}', 'ProjectController@destroy');
Route::post('projects/description/{id}', 'ProjectController@show');

Route::get("project/edit/{id}", 'ProjectController@edit');
Route::post("projects/update", 'ProjectController@update');

//Projects
Route::get('/projects/description',
        function() {
    return view('projects/description');
});
Route::get('all/projects', 'ProjectController@GetAllProject');
Route::get('projects/contribution', 'ProjectController@getContributedProjects');


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

Route::get('/us/create/{id}', 'BacklogController@USCreate');

Route::get('/us/create/{id}', 'BacklogController@USCreate');




//Route::get('searche/project', 'HomeController@search');
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












// If View Don't Exist
Route::get('{view}',
        function ($view) {
    if (view()->exists($view)) {
        return view($view);
    }

    return app()->abort(404, 'Page not found!');
});












