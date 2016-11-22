<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserStoryModel extends Model {

    protected $fillable = [
        'description', 'effort', 'priority', 'id_poject', 'us','id_sprint','tracability',
    ];
    protected $table = 'userstory';

    public function GetUserStory($id) {

        $querry = DB::table('userstory')->where([
                    ['id_project', '=', $id],
                ])
                ->orderBy('us', 'asc')
                ->paginate(5);
        return $querry;
    }

    public function GetUs($id) {
        $querry = DB::table('userstory')->where([
                    ['id_project', '=', $id],
                ])
                ->get();
        return $querry->count() + 1;
    }

    public function tasks() {
        return $this->hasMany('App\TaskModel', 'id_us');
    }

    public function sprint() {
        return $this->belongsTo(
                        'App\SprintModel', 'id_sprint'
        );
    }

}
