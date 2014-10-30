<?php namespace Amu\SuperSharp\Tests;

use Mockery;
use Amu\SuperSharp\Router;
use Amu\SuperSharp\Route;
use Amu\SuperSharp\Http\Request;
use Amu\SuperSharp\Handler\HandlerInterface;
use Amu\SuperSharp\Handler\PassthruHandler;

/**
 * @author Mark Perkins <mark@Amu.com>
 */
class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testReturnedValues()
    {
        $router = new Router();

        $val = $router->add('/foo', function(){});
        $this->assertInstanceOf('Amu\SuperSharp\Route', $val);

        $val = $router->get('/foo', function(){});
        $this->assertInstanceOf('Amu\SuperSharp\Route', $val);

        $val = $router->post('/foo', function(){});
        $this->assertInstanceOf('Amu\SuperSharp\Route', $val);

        $val = $router->put('/foo', function(){});
        $this->assertInstanceOf('Amu\SuperSharp\Route', $val);

        $val = $router->patch('/foo', function(){});
        $this->assertInstanceOf('Amu\SuperSharp\Route', $val);

        $val = $router->delete('/foo', function(){});
        $this->assertInstanceOf('Amu\SuperSharp\Route', $val);
    }

    public function testHandlerCalled()
    {
        $params = ['foo' => 'bar'];
        $request = new Request();
        $handler = Mockery::mock('Amu\SuperSharp\Handler\PassthruHandler');
        $handler->shouldReceive('handle')->once()->andReturn($params);

        $router = new Router($handler);
        $router->add('/foo', null, $params);
        $this->assertEquals($router->match('/foo'), $params);
    }

}