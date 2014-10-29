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

$router = new Clearleft\SuperSharp\Router();

$router->get('/hello', function(){
    return 'Hello world!';
});

echo $router->match('/hello'); // Prints: Hello World!

```

Matching against the current request and returning a response object:

```php

use Clearleft\SuperSharp\Http\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

$router = new Clearleft\SuperSharp\Router();
$router->get('/', function(){
    return new Response('This is the homepage');
});

try {
    $response = $router->match(); // matches against the current request
    $response->send();    
} catch (RouteNotFoundException $e) {
    echo 'No route found';
}

```