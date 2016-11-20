<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'facebook_id', 'github_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects() {
        return $this->hasMany('App\ProjectModel', 'id_user');
    }

    public function contributedProjects() {
//        The code below is equivalent to this SQl query : 
//        select *
//        FROM projects
//        INNER JOIN contributions on contributions.project_id = projects.id
//        WHERE contributions.user_id = Auth::user()->id
        return $this->belongsToMany(
                        'App\ProjectModel', 'contribution', 'id_user',
                        'id_project'
        );
    }

}
