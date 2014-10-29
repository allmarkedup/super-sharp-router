Super Sharp Router
==================

A simple, elegant routing library for PHP 5.4+.

Inspired by (and largely extracted from) [Silex](http://silex.sensiolabs.org) routing and built on [Symfony components](http://symfony.com/doc/current/components/index.html).

- [Installation](#installation)
- [Examples](#examples)

## Installation

Using [Composer](https://getcomposer.org/):

```bash
$ composer require clearleft/super-sharp-router
```

## Examples

The _hello world_ example:

```php
<?php
$router = new Clearleft\SuperSharp\Router();

$router->get('/hello', function(){
    return 'Hello world!';
});

echo $router->match('/hello'); // Prints: Hello World!
```

Matching against the current request and returning a response object:

```php
<?php
use Clearleft\SuperSharp\Http\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

$router = new Clearleft\SuperSharp\Router();
$router->get('/', function(){
    return new Response('This is the homepage');
});

try {
    $response = $router->match(); // matches against the current request
} catch (RouteNotFoundException $e) {
    $response = new Response('No matching route found', 404);
}

$response->send();
```

HTTP-verb based methods, dynamic route parameters and fluent route configuration:

```php
<?php

$router->post('/articles', function(){
    return 'Article added!';
});

$router->get('/articles/{slug}', function($slug){
    return Example::find($slug);
});

$router->get('/users/{id}', function($id){
    return Example::find($id);
})
->assert('id', '\d') // $id route parameter must be a digit
->requireHttps();    // Must be HTTPS
```

## Running tests

Tests can be run using PHP Unit from the command line:

```bash
$ vendor/bin/phpunit
```

The project also includes a [Grunt](http://gruntjs.com) watch task to run the PHP Unit tests when files are updated which you can use for your convenience.
