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

Auth::routes();

Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');




//Facebook
Route::get('auth/facebook', 'FacebookController@redirectToProvider');
Route::get('auth/facebook/callback', 'FacebookController@handleProviderCallback');

//GitHub
Route::get('auth/github', 'GithubController@redirectToProvider');
Route::get('auth/github/callback', 'GithubController@handleProviderCallback');



Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');


Route::get('/home', 'ProjectController@index');



Route::post('/projects/register', 'ProjectController@store');
Route::get('/projects/create', 'ProjectController@create');
Route::post('/projects/destroy/{id}', 'ProjectController@destroy');
Route::post('projects/description/{id}', 'ProjectController@show');

Route::get("project/edit/{id}",'ProjectController@edit');

//Projects
Route::get('/projects/description',function() {
    return view('projects/description');
  });

Route::get('/backlog/add_us',function() {
    return view('backlog/add_us');
  });

//Route::get('searche/project', 'HomeController@search');
Route::get('search/redirect',
        function() {
    $search = urlencode(e(Input::get('search')));
    if ($search) {
        $route = "search/project/$search";
        return redirect($route);
    } else {
        return redirect('home');
    }
});

Route::get("search/project/{search}", 'ProjectController@search');

//**************************
Route::get('search/redirect/all',
        function() {
    $search = urlencode(e(Input::get('search-all')));
    if ($search) {
        $route = "search/project/all/$search";
        return redirect($route);
    } else {
        return redirect('home');
    }
});

Route::get("search/project/all/{search}", 'ProjectController@searchall');




Route::get('{view}',
        function ($view) {
    if (view()->exists($view)) {
        return view($view);
    }

    return app()->abort(404, 'Page not found!');
});


Route::get("contribution/send/{id}",'ProjectController@SendContribution');
Route::get("contribution/remove/{id}",'ProjectController@RemoveContribution');
Route::get("notifications/project",'ProjectController@Notification');


Route::get("notification/description/{idProject}/{idUser}",'ProjectController@ShowNotification' );
Route::get("notification/destroy/{id}",'ProjectController@RefuseNotification' );
Route::get("notification/accept/{id}",'ProjectController@AcceptNotification' );


Route::get("projects/backlog/{id}",'ProjectController@ShowBacklog');





