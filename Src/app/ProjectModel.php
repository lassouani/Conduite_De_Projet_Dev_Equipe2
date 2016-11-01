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
				 ->paginate(5);
    return $MyProject;
        	
}


public function SearcheProject( $searche,$id){

$ResultSearcheProject = DB::table('projects')->where([
                        ['name', 'like', '%'.$searche.'%'],
                        [ 'id_user', '=', $id ]
                        ])
                       ->orWhere ([
                        ['description', 'like', '%'.$searche.'%'],
                        [ 'id_user', '=', $id ]
                        ])
                        ->orderBy('id','desc')
                        ->paginate(1);

return $ResultSearcheProject;

}



}
