<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TaskModel as TaskModel;
use App\ContributionModel as ContributionModel;
use App\User as User;
use App\UserStoryModel as UserStoryModel;
use Illuminate\Support\Facades\Auth;
use App\ProjectModel as ProjectModel;

class TaskController extends Controller {

    public function __construct() {
        $this->task_model = new TaskModel();
        $this->contribution_model = new ContributionModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $users = self::getDevelopers($id);
        $sprints = self::getSprints($id);
        $user_stories = self::getUserStories($id);

        $project = ProjectModel::find($id);
        $other_sprints = $project->sprints;

        return view('tasks.create',
                array('users' => $users, 'project_id' => $id, 'sprints' => $sprints,
            'user_stories' => $user_stories, 'other_sprints' => $other_sprints));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        $this->validate(
                $request,
                [
            'task_description' => 'required|max:200',
            'task_state' => 'required',
            'assigned_developer' => 'required',
            'id_user_story' => 'required',
            'effort' => 'required',
            'priority' => 'required',
                ]
        );

        $this->task_model->description = $request->task_description;
        $this->task_model->state = $request->task_state;
        $this->task_model->id_us = $request->id_user_story;
        $this->task_model->effort = $request->effort;
        $this->task_model->priority = $request->priority;
        $this->task_model->id_developer = $request->assigned_developer;
        $modified = $this->task_model->save();

        $users = self::getDevelopers($id);
        $sprints = self::getSprints($id);
        $user_stories = self::getUserStories($id);


        if ($modified) {
            return view('tasks.create',
                            array('users' => $users, 'project_id' => $id, 'sprints' => $sprints,
                        'user_stories' => $user_stories))->with('status',
                            "La tâche a bien été ajoutée");
        }
        return view('tasks.create',
                        array('users' => $users, 'project_id' => $id, 'sprints' => $sprints,
                    'user_stories' => $user_stories))->with('status_not_modified',
                        "Attention : la tâche la pas été ajoutée");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $querry=$this->task_model->GetTsks($id);
        return view('tasks.Task',array('tasks'=>$querry,'id_us'=>$id));
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

    public function getDevelopers($id) {
        $contribution = ContributionModel::where('id_project', $id)->get();
        $users = [];
        foreach ($contribution as $contr) {
            $users[$contr->developers->id] = $contr->developers->name;
        }

        //if project is not shared
        if (empty($users)) {
            $user = User::find(Auth::user()->id);
            $users[$user->id] = $user->name;
        }
        return $users;
    }

    public function getUserStories($id) {
        $USCollection = UserStoryModel::where('id_project', $id)->get();
        $user_stories = [];
        $i = 0;
        foreach ($USCollection as $user_story) {
            $user_stories[$user_story->id] = ++$i;
        }
        return $user_stories;
    }

}
