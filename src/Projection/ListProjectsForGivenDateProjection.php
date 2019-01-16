<?php

namespace ProjectManagement\Projection;

use DateTime;
use ProjectManagement\Collection\ImputationCollection;
use ProjectManagement\Imputation;

class ListProjectsForGivenDateProjection
{
    /**
     * @var ImputationCollection
     */
    private $collection;
    /**
     * @var DateTime
     */
    private $date;

    public function __construct(DateTime $date, ImputationCollection $collection)
    {
        $this->collection = $collection;
        $this->date = $date;
    }

    public function render()
    {
        $res = array_filter($this->collection->all(), function(Imputation $i) {
            return $i->getPeriod()->getDebut() <= $this->date && $i->getPeriod()->getFin() >= $this->date;
        });

        $byProject = [];
        /** @var Imputation $i */
        foreach ($res as $i) {
            if (!array_key_exists($i->getProject()->getCode(), $byProject)) {
                $byProject[$i->getProject()->getCode()] = [];
            }
            $byProject[$i->getProject()->getCode()][] = $i;

        }

        foreach ($byProject as $projectCode => $is) {
            echo $i->getProject()->getCode() . " // " . $i->getProject()->getName() . PHP_EOL;
            foreach ($is as $i) {
                echo " - " .
                    $i->getEvaneossian()->getLastname() .
                    " " .
                    $i->getEvaneossian()->getFirstname() .
                    " (" . (100*$i->getPercent() . "%)") .
                    PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
}
