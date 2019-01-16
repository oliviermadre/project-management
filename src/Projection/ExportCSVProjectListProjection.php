<?php

namespace ProjectManagement\Projection;

use DateInterval;
use DateTime;
use ProjectManagement\Collection\ImputationCollection;
use ProjectManagement\Imputation;
use ProjectManagement\Period;

class ExportCSVProjectListProjection
{
    /**
     * @var ImputationCollection
     */
    private $collection;
    /**
     * @var Period
     */
    private $period;

    public function __construct(Period $period, ImputationCollection $collection)
    {
        $this->collection = $collection;
        $this->period = $period;
    }

    public function render()
    {
        $currentDate = $this->period->getDebut();
        $byDate = [];
        do {
            $imputations = $this->fetchImputationsForDate($currentDate, $this->collection);

            $byProject = [];
            /** @var Imputation $i */
            foreach ($imputations as $i) {
                if (!array_key_exists($i->getProject()->getCode(), $byProject)) {
                    $byProject[$i->getProject()->getCode()] = [];
                }
                $byProject[$i->getProject()->getCode()][] = $i;

            }
            $byDate[$currentDate->format('Y-m-d')] = $byProject;
            $currentDate->add(new DateInterval('P1D'));
        } while ($this->period->getFin() > $currentDate);

        $header = array_merge(
            [ 'project', 'name'],
            array_keys($byDate)
        );

        echo implode(',', $header) . PHP_EOL;

        foreach ($byDate as $date => $projects) {
            foreach ($projects as $code => $imputations) {

            }
        }




//        foreach ($byProject as $projectCode => $is) {
//            echo $i->getProject()->getCode() . " // " . $i->getProject()->getName() . PHP_EOL;
//            foreach ($is as $i) {
//                echo " - " .
//                    $i->getEvaneossian()->getLastname() .
//                    " " .
//                    $i->getEvaneossian()->getFirstname() .
//                    " (" . (100*$i->getPercent() . "%)") .
//                    PHP_EOL;
//            }
//            echo PHP_EOL;
//        }
    }

    private function fetchImputationsForDate(DateTime $currentDate, ImputationCollection $imputations)
    {
        return array_filter($imputations->all(), function(Imputation $i) use ($currentDate) {
            return $i->getPeriod()->getDebut() <= $currentDate && $i->getPeriod()->getFin() >= $currentDate;
        });
    }

    private function countNbDays()
    {
        $currentDate = $this->period->getDebut();
        $cpt = 1;
        do {
            $cpt++;
            $currentDate->add(new DateInterval('P1D'));
        } while ($this->period->getFin() > $currentDate);

        return $cpt;
    }
}
