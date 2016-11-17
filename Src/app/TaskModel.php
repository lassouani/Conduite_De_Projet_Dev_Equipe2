<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model {

    protected $table = 'taches';

    public function sprint() {
        return $this->belongsTo('App\SprintModel', 'id_sprint');
    }

}
