<?php

namespace ProjectManagement\Repository;

use ProjectManagement\Collection\ProjectCollection;
use ProjectManagement\Project;

class ProjectJsonRepository
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function findAll()
    {
        $rawContent = file_get_contents($this->path);
        $projectsJson = json_decode($rawContent, true);

        $col = new ProjectCollection();

        foreach ($projectsJson as $project) {
            $col->add(Project::createFromJson($project));
        }

        return $col;
    }
}
