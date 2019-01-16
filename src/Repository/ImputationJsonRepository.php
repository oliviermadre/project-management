<?php

namespace ProjectManagement\Repository;

use ProjectManagement\Collection\EvaneossianCollection;
use ProjectManagement\Collection\ImputationCollection;
use ProjectManagement\Collection\ProjectCollection;
use ProjectManagement\Imputation;
use ProjectManagement\Period;
use ProjectManagement\Project;

class ImputationJsonRepository
{
    private $path;
    /**
     * @var EvaneossianCollection
     */
    private $evaneossianCollection;
    /**
     * @var ProjectCollection
     */
    private $projectCollection;

    public function __construct($path, EvaneossianCollection $evaneossianCollection, ProjectCollection $projectCollection)
    {
        $this->path = $path;
        $this->evaneossianCollection = $evaneossianCollection;
        $this->projectCollection = $projectCollection;
    }

    public function findAll()
    {
        $rawContent = file_get_contents($this->path);
        $imputationJson = json_decode($rawContent, true);

        $col = new ImputationCollection();

        foreach ($imputationJson as $imputation) {
            $evaneossian = $this->evaneossianCollection->findAll($imputation[0])->first();
            $period = Period::createFromString($imputation[1], $imputation[2]);
            $project = $this->projectCollection->get($imputation[3]);
            $col->add(new Imputation($period, $evaneossian, $project));
        }

        return $col;
    }
}
