<?php

namespace ProjectManagement\Repository;

use ProjectManagement\Collection\EvaneossianCollection;
use ProjectManagement\Evaneossian;

class CollaboratorJsonRepository
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function findAll()
    {
        $rawContent = file_get_contents($this->path);
        $collaboratorsJson = (json_decode($rawContent, true))['data']['items'];

        $evaneossianCollection = new EvaneossianCollection();
        foreach ($collaboratorsJson as $collaborator) {
            $evaneossian = Evaneossian::createFromJson($collaborator['item']);
            $evaneossianCollection->add($evaneossian);
        }

        return $evaneossianCollection;
    }
}
