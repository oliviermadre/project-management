<?php

namespace ProjectManagement\Projection;

use DateTime;
use ProjectManagement\Collection\ImputationCollection;
use ProjectManagement\Evaneossian;
use ProjectManagement\Imputation;

class ListEvaneossianImputationForGivenDateProjection
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

        $byEvaneossian = [];
        /** @var Imputation $i */
        foreach ($res as $i) {
            if (!array_key_exists($i->getEvaneossian()->getMatricule(), $byEvaneossian)) {
                $byEvaneossian[$i->getEvaneossian()->getMatricule()] = [];
            }
            $byEvaneossian[$i->getEvaneossian()->getMatricule()][] = $i;

        }

        foreach ($byEvaneossian as $matricule => $is) {
            /** @var Evaneossian $evaneossian */
            $evaneossian = (reset($is))->getEvaneossian();
            echo $evaneossian->getLastname() . " " . $evaneossian->getFirstname() . PHP_EOL;
            foreach ($is as $i) {
                echo " - " .
                    $i->getProject()->getCode() .
                    " // " .
                    $i->getProject()->getName() .
                    " (" . (100*$i->getPercent() . "%)") .
                    PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
}
