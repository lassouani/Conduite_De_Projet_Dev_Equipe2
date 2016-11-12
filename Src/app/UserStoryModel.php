<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserStoryModel extends Model
{
    

 protected $fillable = [
        'description', 'effort', 'priority', 'id_poject','us',
    ];
    protected $table = 'userstory';


public function GetUserStory($id){

	$querry = DB::table('userstory')->where([
	                    ['id_project', '=', $id],
	                    
	                ])
	                ->orderBy('us', 'asc')
	                ->paginate(5);
	    return $querry;            
}


public function GetUs($id){
	$querry = DB::table('userstory')->where([
	                    ['id_project', '=', $id],
	                    
	                ])
	                ->get();
	    return $querry->count()+1;    
}

}