<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContributionModel as ContributionModel;

class ContributionController extends Controller {

    private $contribution_model = null;

    public function __construct() {
        $this->contribution_model = new ContributionModel();
    }

    public function searchContributedProject($search) {
        $search = urldecode($search);
        $searchResult = $this->contribution_model->searchContributedProject($search);

        return view(
                'projects.resultSearch',
                array('Projects' => $searchResult, 'search' => $search)
        );
    }

}
