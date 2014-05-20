<?php

namespace TheUnraveler\TodoBy\Tests;

use TheUnraveler\TodoBy\TodoExpiredException;

class TodoExpiredExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testExpiryDateIsIncludedInTheStringRepresentation()
    {
        $exception = new TodoExpiredException('This is the message');

        $time = time();
        $exception->setExpiredDate($time);

        $formatted = date('n/j/y \\a\\t g:ia', $time);
        $this->assertEquals(
            'The todo "This is the message" is expired as of ' . $formatted . '! Fix it now!',
            (string) $exception
        );
    }

    public function testHandlesDateTimeObjects()
    {
        $exception = new TodoExpiredException('This is the message');

        $time = new \DateTime;
        $exception->setExpiredDate($time);

        $this->assertEquals($time->format('U'), $exception->getExpiredDate());
    }
}
