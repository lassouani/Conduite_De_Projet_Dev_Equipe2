<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KanBanModel extends Model {

    protected $table = 'kanban';
    protected $fillable = [
        'id_sprint',
    ];

    public function kanban() {
        return $this->belongsTo('App\Sprint', 'id_sprint');
    }


public function GetKanBan($idProject,$idSprint){

	 $querry = DB::table('projects')

	            ->join('sprint', 'sprint.id_project', '=',    //
                        'projects.id')

                ->join('userstory', 'userstory.id_project', '=',   //
                        'projects.id')

                ->join('taches', 'taches.id_us', '=', 'userstory.id')  //

                ->select('taches.description', 'taches.state',     //
                        'taches.effort','taches.priority', 
                            'sprint.sprint_number','sprint.id','projects.id')

                //->where('sprint.id', '!=', $idSprint)  // 

                ->where('userstory.id_project', '=', $idProject)

                ->where('sprint.sprint_number', '=', $idSprint)

                
                ->get();
        return $querry;
}

}
