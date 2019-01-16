<?php

namespace ProjectManagement;

class Project
{
    private $name;
    private $code;

    public function __construct($code, $name)
    {
        $this->name = $name;
        $this->code = $code;
    }

    public static function createFromJson($project)
    {
        return new self($project['code'], $project['name']);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
