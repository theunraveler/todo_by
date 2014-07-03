<?php

namespace TheUnraveler\TodoBy\Tests;

use TheUnraveler\TodoBy\TodoExpiredException;

class TodoExpiredExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testExpiryDateIsIncludedInTheStringRepresentation()
    {
        $exception = new TodoExpiredException('This is the message');
        $time = new \DateTime;
        $exception->setExpiredDate($time);

        $this->assertEquals(
            'The todo "This is the message" is expired as of ' . $time->format('n/j/y \\a\\t g:ia') . '! Fix it now!',
            (string) $exception
        );
    }
}
