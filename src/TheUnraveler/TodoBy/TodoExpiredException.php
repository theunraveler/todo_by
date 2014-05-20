<?php

namespace TheUnraveler\TodoBy;

class TodoExpiredException extends \RuntimeException
{
    protected $expiredDate;

    public function setExpiredDate($date)
    {
        if ($date instanceof \DateTime) {
            $date = $date->format('U');
        }

        $this->expireDate = $date;
    }

    public function getExpiredDate()
    {
        return $this->expireDate;
    }

    public function __toString()
    {
        return sprintf(
            'The todo "%s" is expired as of %s! Fix it now!',
            $this->getMessage(),
            date('n/j/y \\a\\t g:ia', $this->getExpiredDate())
        );
    }
}
