<?php

namespace ProjectManagement;

use DateTime;

class Period
{
    /**
     * @var DateTime
     */
    private $debut;
    /**
     * @var DateTime
     */
    private $fin;

    public function __construct(DateTime $debut, DateTime $fin)
    {
        $this->debut = $debut;
        $this->fin = $fin;
    }

    public static function createFromString($debut, $fin)
    {
        $debutFull = $debut . ' 09:30:00';
        $finFull = $fin . ' 19:00:00';
        return new Period(
            DateTime::createFromFormat('Y-m-d H:i:s', $debutFull),
            DateTime::createFromFormat('Y-m-d H:i:s', $finFull)
        );
    }

    /**
     * @return DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @return DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }
}
