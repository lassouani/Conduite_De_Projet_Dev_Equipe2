<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\SprintModel as SprintModel;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function getSprints($id) {
        $sprintCollection = SprintModel::where('id_project', $id)->get();
        $sprints = [];
        $i = 0;
        foreach ($sprintCollection as $sprint) {
            $sprints[$sprint->id] = ++$i;
        }
        return $sprints;
    }

}
