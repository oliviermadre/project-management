<?php

namespace ProjectManagement;

class Evaneossian
{
    private $firstname;
    private $lastname;
    /**
     * @var Job
     */
    private $job;
    private $matricule;

    public function __construct($matricule, $firstname, $lastname, Job $job)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->job = $job;
        $this->matricule = $matricule;
    }

    public static function createFromJson($data)
    {
        return new self($data['id'], $data['firstName'], strtoupper($data['lastName']), new Job($data['jobTitle']));
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

}
