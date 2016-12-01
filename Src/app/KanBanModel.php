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


public function GetKanBanTODO($idProject,$NumSprint){

	 $querry = DB::table('userstory')

	            ->join('taches', 'userstory.id', '=',    //
                        'taches.id_us')

                ->select('taches.description', 'taches.state',     //
                        'taches.effort','taches.priority', 
                            'userstory.sprint_number','taches.id','taches.us',
                            'taches.task_number','taches.created_at','taches.effort')

                ->where('userstory.id_project', '=', $idProject)

                ->where('userstory.sprint_number', '=', $NumSprint)

                ->where('taches.state', '=', 'TODO')
               
                ->get();
        return $querry;
}

public function GetKanBanONDOING($idProject,$NumSprint){

     $querry = DB::table('userstory')

                ->join('taches', 'userstory.id', '=',    //
                        'taches.id_us')

                ->select('taches.description', 'taches.state',     //
                        'taches.effort','taches.priority', 
                            'userstory.sprint_number','taches.id','taches.us',
                            'taches.task_number','taches.created_at','taches.effort')

                ->where('userstory.id_project', '=', $idProject)

                ->where('userstory.sprint_number', '=', $NumSprint)

                ->where('taches.state', '=', 'ON DOING')
               
                ->get();
        return $querry;
}


public function GetKanBanTESTING($idProject,$NumSprint){

     $querry = DB::table('userstory')

                ->join('taches', 'userstory.id', '=',    //
                        'taches.id_us')

                ->select('taches.description', 'taches.state',     //
                        'taches.effort','taches.priority', 
                            'userstory.sprint_number','taches.id','taches.us',
                            'taches.task_number','taches.created_at','taches.effort')

                ->where('userstory.id_project', '=', $idProject)

                ->where('userstory.sprint_number', '=', $NumSprint)

                ->where('taches.state', '=', 'TESTING')
               
                ->get();
        return $querry;
}


public function GetKanBanDONE($idProject,$NumSprint){

     $querry = DB::table('userstory')

                ->join('taches', 'userstory.id', '=',    //
                        'taches.id_us')

                ->select('taches.description', 'taches.state',     //
                        'taches.effort','taches.priority', 
                            'userstory.sprint_number','taches.id','taches.us',
                            'taches.task_number','taches.created_at','taches.effort')

                ->where('userstory.id_project', '=', $idProject)

                ->where('userstory.sprint_number', '=', $NumSprint)

                ->where('taches.state', '=', 'DONE')
               
                ->get();
        return $querry;
}

}
