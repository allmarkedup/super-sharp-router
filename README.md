Super Sharp Router
==================

A simple, elegant routing library for PHP 5.4+.

Inspired by the [Silex](http://silex.sensiolabs.org) routing style and built on [Symfony components](http://symfony.com/doc/current/components/index.html).

## Installation

Using [Composer](https://getcomposer.org/):

```bash
$ composer require clearleft/super-sharp-router
```

## Examples

The _hello world_ example:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$router = new Clearleft\SuperSharp\Router();

$router->get('/foo', function(){
    return 'Hello world!';
});

echo $router->match('/foo'); // Prints: Hello World!

```