Todo By
=======

This is a PHP implementation of the `do_by` Rubygem (https://github.com/andyw8/do_by). It's for adding auto-expiring TODO notes to a project.

[![Build Status](https://secure.travis-ci.org/theunraveler/todo_by.png)](http://travis-ci.org/theunraveler/todo_by)
[![Coverage Status](https://coveralls.io/repos/theunraveler/todo_by/badge.png?branch=master)](https://coveralls.io/r/theunraveler/todo_by?branch=master)
[![Latest Stable Version](https://poser.pugx.org/theunraveler/todo_by/v/stable.svg)](https://packagist.org/packages/theunraveler/todo_by)

Usage
-----

```php
use TheUnraveler\TodoBy\Todo;

// Globally enable TODO expiration. If TODO expiration is enabled and your code
// runs into an expired TODO, a TodoExpiredException will be thrown.
Todo::enable();

// Globally disable TODO expiration. This means that exceptions will not be
// thrown when expired TODOs are encountered. Good for production.
Todo::disable();

// Creates a new TODO that will expire on the given date.
new Todo('Implement feature X', time()); // Expiration date can be set with a timestamp,
new Todo('Implement feature Y', new \DateTime('now')); // ...a DateTime object,
new Todo('Implement feature Z', '+ 2 weeks'); // ...or anything parsable by new \DateTime.

// Alternatively...
Todo::create('Implement feature AA', '+ 2 weeks');
```

Tests
-----

To run unit tests, first install dependencies (`composer install`), then run
PHPUnit (`bin/phpunit`).
