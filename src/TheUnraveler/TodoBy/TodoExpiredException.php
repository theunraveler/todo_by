<?php

namespace TheUnraveler\TodoBy;

class TodoExpiredException extends \RuntimeException
{
    protected $expiredDate;

    /**
     * Set the expiration date.
     *
     * @param DateTime $date
     *
     * @return self
     */
    public function setExpiredDate(\DateTime $date)
    {
        $this->expiredDate = $date;
        return $this;
    }

    /**
     * Gets the expiration date.
     *
     * @return DateTime
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * Implements __toString().
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            'The todo "%s" is expired as of %s! Fix it now!',
            $this->getMessage(),
            $this->getExpiredDate()->format('n/j/y \\a\\t g:ia')
        );
    }
}
