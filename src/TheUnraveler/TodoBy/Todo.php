<?php

namespace TheUnraveler\TodoBy;

class Todo
{
    protected static $enabled = true;

    public function __construct($message, $date = null)
    {
        if (!$date || !static::isEnabled()) {
            return;
        }

        if ($date instanceof \DateTime) {
            $date = $date->format('U');
        }

        if (time() < $date) {
            return;
        }

        $exception = new TodoExpiredException($message);
        $exception->setExpiredDate($date);
        throw $exception;
    }

    public static function isEnabled()
    {
        return static::$enabled;
    }

    public static function setEnabled($enabled)
    {
        static::$enabled = $enabled;
    }

    public static function enable()
    {
        static::setEnabled(true);
    }

    public static function disable()
    {
        static::setEnabled(false);
    }

    public static function create($message, $date = null)
    {
        $class = get_called_class();
        return new $class($message, $date);
    }
}
