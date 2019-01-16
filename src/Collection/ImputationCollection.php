<?php

namespace ProjectManagement\Collection;

use ProjectManagement\Imputation;

class ImputationCollection
{
    /**
     * @var Imputation[]
     */
    private $col = [];


    public function add(Imputation $e)
    {
        $this->col[$e->getId()] = $e;
        uasort($this->col, function(Imputation $a, Imputation $b) {
            return $a->getPeriod()->getDebut() > $b->getPeriod()->getDebut() ? 1 : -1;
        });
    }

    public function del($id)
    {
        unset($this->col[$id]);
    }

    public function hasId($id)
    {
        return array_key_exists($id, $this->col);
    }

    public function has(Imputation $e)
    {
        return $this->hasId($e->getId());
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
     * @param $id
     * @return null|Imputation
     */
    public function get($id)
    {
        return $this->hasId($id) ? $this->col[$id] : null;
    }
}
