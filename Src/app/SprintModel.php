<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SprintModel extends Model {

    protected $table = 'sprint';
    protected $fillable = [
        'sprint_number','start_date','end_date','id_project','id_us'
    ];

    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

 public function GetAllSprints($id) {

        $AllProject = DB::table('sprint')->where([
                    ['id_project', '=', $id]
                ])
                ->paginate(10);
        return $AllSprints;
    }
     //   public function user_story() {

     //   return $this->belongsTo('App\UserStoryModel', 'id_us');
 //   }
    
    public function userstories() {
        return $this->hasMany('App\UserStoryModel', 'id_sprint');
    }

}
