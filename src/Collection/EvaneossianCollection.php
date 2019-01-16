<?php

namespace ProjectManagement\Collection;

use ProjectManagement\Evaneossian;

class EvaneossianCollection
{
    /**
     * @var Evaneossian[]
     */
    private $col = [];

    const FILTER_DEVELOPER = [
        'Développeur',
        'DevOps',
        'iOS Developer',
        'Développeur iOS',
        'Développeur Android',
        'Lead Dev Tipi',
        'Back-End Developer',
        'DÉVELOPPEUSE',
        'Developpeur'
    ];

    const FILTER_PM = [
        'Product manager',
        'Product Manager',
        'Product Manager @ WWW',
        'Product Owner',
        'Conversion optimisation manager'
    ];


    public function add(Evaneossian $e)
    {
        $this->col[$e->getMatricule()] = $e;
        uasort($this->col, function(Evaneossian $a, Evaneossian $b) {
            return $a->getLastname() > $b->getLastname() ? 1 : -1;
        });
    }

    public function del($matricule)
    {
        unset($this->col[$matricule]);
    }

    public function hasMatricule($matricule)
    {
        return array_key_exists($matricule, $this->col);
    }

    public function has(Evaneossian $e)
    {
        return $this->hasMatricule($e->getMatricule());
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
     * @param array $titles
     * @return EvaneossianCollection
     */
    public function filter(array $titles = [])
    {
        $col = new self();

        if (empty($titles)) {
            return $col;
        }

        foreach ($this->col as $evaneossian) {
            if (in_array($evaneossian->getJob(), $titles))
            {
                $col->add($evaneossian);
            }
        }
        return $col;
    }

    public function findAll($text)
    {
        $col = new self();

        foreach ($this->col as $evaneossian) {
            if (preg_match('`' . $text . '`i', $evaneossian->getFirstname())) {
               $col->add($evaneossian);
            }

            if (preg_match('`' . $text . '`i', $evaneossian->getLastname())) {
                $col->add($evaneossian);
            }
        }

        if ($col->count() === 0) {
            return null;
        }

        return $col;
    }
}
