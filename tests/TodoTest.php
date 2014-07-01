<?php

namespace TheUnraveler\TodoBy\Tests;

use TheUnraveler\TodoBy\Todo;

class TodoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider expired
     */
    public function testExpiredTodosThrowAnException($time)
    {
        Todo::enable();
        $this->setExpectedException('TheUnraveler\TodoBy\TodoExpiredException', 'This todo is expired');
        Todo::create('This todo is expired', $time);
    }

    /**
     * @dataProvider future
     */
    public function testFutureTodosDoNotThrowAnException($time)
    {
        Todo::enable();
        Todo::create('This todo is not expired', $time);
    }

    public function testNoExceptionIsThrownIfTheDateIsEmpty()
    {
        Todo::enable();
        Todo::create('This todo is not expired');
    }

    public function testNoExceptionIsThrownFunctionalityIsDisabled()
    {
        Todo::disable();
        Todo::create('This todo is expired, but it doesn\'t matter', time() - 100);
    }

    public function expired()
    {
        return array(
            array(time() - 100),
            array(new \DateTime('10 minutes ago')),
            array('10 minutes ago')
        );
    }

    public function future()
    {
        return array(
            array(time() + 100),
            array(new \DateTime('+ 10 minutes')),
            array('+ 10 minutes')
        );
    }
}
