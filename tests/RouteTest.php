<?php namespace Clearleft\SuperSharp\Tests;

use Clearleft\SuperSharp\Router;
use Clearleft\SuperSharp\Route;

/**
 * @author Mark Perkins <mark@clearleft.com>
 */
class RouteTest extends \PHPUnit_Framework_TestCase
{
    public function testConvenienceMethods()
    {
        $route = new Route();

        $route->assert('foo', '.+');
        $this->assertEquals($route->getRequirement('foo'), '.+');

        $route->value('foo', 'bar');
        $this->assertEquals($route->getDefault('foo'), 'bar');

        $route->method('POST');
        $this->assertEquals($route->getMethods(), ['POST']);

        $route->method('POST|GET');
        $this->assertEquals($route->getMethods(), ['POST', 'GET']);

        $route->host('www.test.com');
        $this->assertEquals($route->getHost(), 'www.test.com');

        $route->requireHttp();
        $this->assertEquals($route->getSchemes(), ['http']);

        $route->requireHttps();
        $this->assertEquals($route->getSchemes(), ['https']);

        $route->name('foo');
        $this->assertEquals($route->getName(), 'foo');
    }

    public function testNameIsGeneratedIfNotSet()
    {
        $route = new Route();
        $this->assertNotEmpty($route->getName());
    }


}