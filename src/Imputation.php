<?php

namespace ProjectManagement;

class Imputation
{
    private $id;
    /**
     * @var Evaneossian
     */
    private $evaneossian;
    /**
     * @var Project
     */
    private $project;
    /**
     * @var Period
     */
    private $period;
    /**
     * @var int
     */
    private $percent;

    public function __construct(Period $period, Evaneossian $evaneossian, Project $project, $percent = 1)
    {
        $this->evaneossian = $evaneossian;
        $this->project = $project;
        $this->period = $period;
        $this->percent = $percent;
        $this->id = uniqid("", true);
    }

    /**
     * @return Evaneossian
     */
    public function getEvaneossian()
    {
        return $this->evaneossian;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return Period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}