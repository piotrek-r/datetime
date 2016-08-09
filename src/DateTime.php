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
}
