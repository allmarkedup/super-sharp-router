<?php

require 'vendor/autoload.php';

use Clearleft\SuperSharp\Router;

$router = new Router();

$router->get('/foo', ['hello'=>'test']);

$result = $router->match('/foo');

echo '<pre>';
print_r($result);
echo '</pre>';