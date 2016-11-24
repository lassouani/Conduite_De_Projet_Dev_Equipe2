<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskModel extends Model {

    protected $table = 'taches';
    

    public function sprint() {
        return $this->belongsTo('App\SprintModel', 'id_sprint');
    }


    public function GetTsks($id){
    	 $querry = DB::table('taches')->where('id_us', $id)
                ->paginate(10);
        return $querry;
    }

}
