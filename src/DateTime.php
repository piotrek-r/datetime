<?php

namespace PiotrekR\DateTime;

/**
 * Class DateTime
 * @package PiotrekR\DateTime
 */
class DateTime extends \DateTimeImmutable
{
    const DOW_MONDAY = 1;
    const DOW_TUESDAY = 2;
    const DOW_WEDNESDAY = 3;
    const DOW_THURSDAY = 4;
    const DOW_FRIDAY = 5;
    const DOW_SATURDAY = 6;
    const DOW_SUNDAY = 7;

    /**
     * @param \DateTimeInterface $dateTime
     * @return DateTime
     */
    public static function createFromDateTime(\DateTimeInterface $dateTime)
    {
        return (new self($dateTime->format('c')));
    }

    /**
     * @return DateTime
     */
    public static function now()
    {
        return new self();
    }

    /**
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function startOfDay()
    {
        return $this->setTime(0, 0, 0);
    }

    /**
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function endOfDay()
    {
        return $this->setTime(23, 59, 59);
    }

    /**
     * @param bool $startOfDay
     * @param int $firstDay
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function startOfWeek($startOfDay = true, $firstDay = self::DOW_MONDAY)
    {
        $diff = $this->dow() - $firstDay;

        if ($diff < 0) {
            $diff += 7;
        }

        /** @var bool|\DateTimeImmutable|DateTime $date */
        $date = $this->sub(new DateInterval(sprintf('P%dD', $diff)));

        if ($startOfDay) {
            $date = $date->startOfDay();
        }

        return $date;
    }

    /**
     * @param bool $endOfDay
     * @param int $lastDay
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function endOfWeek($endOfDay = true, $lastDay = self::DOW_SUNDAY)
    {
        $diff = $lastDay - $this->dow();

        if ($diff < 0) {
            $diff += 7;
        }

        /** @var bool|\DateTimeImmutable|DateTime $date */
        $date = $this->add(new DateInterval(sprintf('P%dD', $diff)));

        if ($endOfDay) {
            $date = $date->endOfDay();
        }

        return $date;
    }

    /**
     * @param bool $startOfDay
     * @return bool|\DateTimeImmutable|DateTime
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
     * @return bool|\DateTimeImmutable|DateTime
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

    /**
     * @param bool $startOfDay
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function startOfYear($startOfDay = true)
    {
        if ($startOfDay) {
            $date = $this->startOfDay();
        } else {
            $date = $this;
        }
        return $date->setDate($date->format('Y'), 1, 1);
    }

    /**
     * @param bool $endOfDay
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function endOfYear($endOfDay = true)
    {
        if ($endOfDay) {
            $date = $this->endOfDay();
        } else {
            $date = $this;
        }
        return $date->setDate($date->format('Y'), 12, 31);
    }

    /**
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function yesterday()
    {
        return $this->sub(new DateInterval('P1D'));
    }

    /**
     * @return bool|\DateTimeImmutable|DateTime
     */
    public function tomorrow()
    {
        return $this->add(new DateInterval('P1D'));
    }

    /**
     * @return int
     */
    public function dow()
    {
        return (int)$this->format('N');
    }

    /**
     * @return bool
     */
    public function isWeekday()
    {
        return !$this->isWeekend();
    }

    /**
     * @return bool
     */
    public function isWeekend()
    {
        return in_array($this->dow(), [self::DOW_SATURDAY, self::DOW_SUNDAY]);
    }

    /**
     * @return \DateTime
     */
    public function toDateTime()
    {
        return new \DateTime($this->format('c'));
    }

    /**
     * @return \DateTimeImmutable
     */
    public function toDateTimeImmutable()
    {
        return new \DateTimeImmutable($this->format('c'));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'y' => (int)$this->format('Y'),
            'm' => (int)$this->format('n'),
            'd' => (int)$this->format('j'),
            'h' => (int)$this->format('G'),
            'i' => (int)$this->format('i'),
            's' => (int)$this->format('s'),
        ];
    }
}
