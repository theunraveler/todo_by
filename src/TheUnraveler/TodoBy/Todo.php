<?php

namespace TheUnraveler\TodoBy;

class Todo
{
    protected $message, $expirationDate;
    protected static $enabled = true;

    /**
     * Constructs a new Todo.
     *
     * @param string $message
     * @param mixeed $date
     *
     * @return TheUnraveler\TodoBy\Todo
     *
     * @throws TheUnraveler\TodoBy\TodoExpiredException
     */
    public function __construct($message, $date = null)
    {
        $this->message = $message;
        $this->expirationDate = $date ? static::normalizeDate($date) : null;
        $this->checkExpiration();
    }

    /**
     * Returns the TODO message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns the expiration date.
     *
     * @return DateTime|null
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Whether TODO expiration functionality is enabled.
     *
     * @return boolean
     */
    public static function isEnabled()
    {
        return static::$enabled;
    }

    /**
     * Set whether TODO expiration functionality is enabled.
     *
     * @param boolean $enabled
     */
    public static function setEnabled($enabled)
    {
        static::$enabled = $enabled;
    }

    /**
     * Enable TODO expiration functionality.
     */
    public static function enable()
    {
        static::setEnabled(true);
    }

    /**
     * Disable TODO expiration functionality.
     */
    public static function disable()
    {
        static::setEnabled(false);
    }

    /**
     * Helper method to create new instances of this class.
     *
     * @param string $message
     * @param mixed $date
     *
     * @return TheUnraveler\TodoBy\Todo
     *
     * @throws TheUnraveler\TodoBy\TodoExpiredException
     */
    public static function create($message, $date = null)
    {
        $class = get_called_class();
        return new $class($message, $date);
    }

    /**
     * Helper method to expire a TODO.
     *
     * @throws TheUnraveler\TodoBy\TodoExpiredException
     */
    protected function checkExpiration()
    {
        if (!static::isEnabled()) {
            return;
        }

        $expiry = $this->getExpirationDate();

        if (!$expiry || $expiry > new \DateTime('now')) {
            return;
        }

        $exception = new TodoExpiredException($this->getMessage());
        $exception->setExpiredDate($expiry);
        throw $exception;
    }

    /**
     * Helper method to create a DateTime object from various formats.
     *
     * @param mixed $date
     *   Supports integers, DateTime objects, or anything that can be passed to 
     *   `new DateTime`.
     *
     * @return DateTime
     */
    protected static function normalizeDate($date)
    {
        if (is_int($date)) {
            return \DateTime::createFromFormat('U', $date);
        }

        if (!($date instanceof \DateTime)) {
            return new \DateTime($date);
        }

        return $date;
    }
}
