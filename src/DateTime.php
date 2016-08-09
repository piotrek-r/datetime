<?php

namespace PiotrekR\DateTime;

/**
 * Class DateTime
 * @package PiotrekR\DateTime
 */
class DateTime extends \DateTimeImmutable
{
    /**
     * @return DateTime
     */
    public static function now()
    {
        return new self();
    }

    /**
     * @return bool|DateTime
     */
    public function startOfDay()
    {
        return $this->setTime(0, 0, 0);
    }

    /**
     * @return bool|DateTime
     */
    public function endOfDay()
    {
        return $this->setTime(23, 59, 59);
    }

    /**
     * @param bool $startOfDay
     * @return bool|DateTime
     */
    public function startOfMonth($startOfDay = true)
    {
        if ($startOfDay) {
            $date = $this->startOfDay();
        } else {
            $date = $this;
        }
        return $date->setDate($date->format('Y'), $date->format('m'), 1);
    }

    /**
     * @param bool $endOfDay
     * @return bool|DateTime
     */
    public function endOfMonth($endOfDay = true)
    {
        if ($endOfDay) {
            $date = $this->endOfDay();
        } else {
            $date = $this;
        }
        return $date->setDate($date->format('Y'), $date->format('m'), $date->format('t'));
    }
}
