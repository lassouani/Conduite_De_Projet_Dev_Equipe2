<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectModel extends Model {

    protected $fillable = [
        'name', 'description', 'link', 'id_user'
    ];
    protected $table = 'projects';

    public function GetMyProject($id) {

        $MyProject = DB::table('projects')->where('id_user', $id)
                ->paginate(10);
        return $MyProject;
    }

    public function SearcheProject($search, $id) {

        $ResultSearcheProject = DB::table('projects')->where([
                    ['name', 'like', '%' . $search . '%'],
                    [ 'id_user', '=', $id]
                ])
                ->orWhere([
                    ['description', 'like', '%' . $search . '%'],
                    [ 'id_user', '=', $id]
                ])
                ->orderBy('id', 'desc')
                ->paginate(10);

        return $ResultSearcheProject;
    }

    public function GetAllProject($id) {

        $AllProject = DB::table('projects')->where([
                    ['id_user', '!=', $id]
                ])
                ->paginate(10);
        return $AllProject;
    }

    /* public function GetAllProjectS() {

      $AllProject = DB::table('projects')
      ->paginate(10);
      return $AllProject;
      } */

    public function SearchAllProject($search) {

        $ResultSearcheProject = DB::table('projects')->where([
                    ['name', 'like', '%' . $search . '%']
                ])
                ->orWhere([
                    ['description', 'like', '%' . $search . '%']
                ])
                ->orderBy('id', 'desc')
                ->paginate(10);

        return $ResultSearcheProject;
    }

    public function searchPublicProject($search) {
        $contributed_projects = DB::table('projects')
                ->where('public', '=', true)
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', "%" . $search . "%")
                ->groupBy('id')
                ->paginate(5);

        return $contributed_projects;
    }

    public function user() {

        return $this->belongsTo('App\User', 'id_user');
    }

    public function GetProject($id) {


        $Project = DB::table('projects')->where([
                    ['id', '=', $id]])
                ->first();

        return $Project;
    }

    public function sprints() {
        return $this->hasMany('App\SprintModel', 'id_project');
    }

}
