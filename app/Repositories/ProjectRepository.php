<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository {

    public function index(){
        return Project::paginate(10);
    }
}
