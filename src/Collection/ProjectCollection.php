<?php

namespace ProjectManagement\Collection;

use ProjectManagement\Project;

class ProjectCollection
{
    /**
     * @var Project[]
     */
    private $col = [];


    public function add(Project $e)
    {
        $this->col[$e->getCode()] = $e;
        uasort($this->col, function(Project $a, Project $b) {
            return $a->getCode() > $b->getCode() ? 1 : -1;
        });
    }

    public function del($code)
    {
        unset($this->col[$code]);
    }

    public function hasCode($code)
    {
        return array_key_exists($code, $this->col);
    }

    public function has(Project $e)
    {
        return $this->hasCode($e->getCode());
    }

    public function first()
    {
        return reset($this->col);
    }

    public function all()
    {
        return $this->col;
    }

    public function count()
    {
        return count($this->col);
    }

    /**
     * @param $code
     * @return null|Project
     */
    public function get($code)
    {
        return $this->hasCode($code) ? $this->col[$code] : null;
    }
}
