<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectModel extends Model
{
	protected $fillable = [
        'name', 'description', 'link','id_user'
    ];

     protected $table = 'projects';
	
    public static function GetMyProject($id){


    $MyProject = DB::table('projects')->where('id_user', $id)
				->paginate(10);
    return $MyProject;
        	
}



}
