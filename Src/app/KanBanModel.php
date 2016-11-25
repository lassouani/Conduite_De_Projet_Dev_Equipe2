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

}
