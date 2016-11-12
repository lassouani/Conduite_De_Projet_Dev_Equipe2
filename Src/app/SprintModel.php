<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SprintModel extends Model {

    protected $table = 'sprint';
    protected $fillable = [
        'id_project',
    ];

    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

    public function kanban() {
        return $this->belongsTo('App\KanBan', 'id_kanban');
    }

}
