<?php namespace Clearleft\SuperSharp\Tests;

use Mockery;
use Clearleft\SuperSharp\Router;
use Clearleft\SuperSharp\Route;
use Clearleft\SuperSharp\Http\Request;
use Clearleft\SuperSharp\Handler\HandlerInterface;
use Clearleft\SuperSharp\Handler\PassthruHandler;

/**
 * @author Mark Perkins <mark@clearleft.com>
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
        $this->assertInstanceOf('Clearleft\SuperSharp\Route', $val);

        $val = $router->get('/foo', function(){});
        $this->assertInstanceOf('Clearleft\SuperSharp\Route', $val);

        $val = $router->post('/foo', function(){});
        $this->assertInstanceOf('Clearleft\SuperSharp\Route', $val);

        $val = $router->put('/foo', function(){});
        $this->assertInstanceOf('Clearleft\SuperSharp\Route', $val);

        $val = $router->patch('/foo', function(){});
        $this->assertInstanceOf('Clearleft\SuperSharp\Route', $val);

        $val = $router->delete('/foo', function(){});
        $this->assertInstanceOf('Clearleft\SuperSharp\Route', $val);
    }

    public function testHandlerCalled()
    {
        $params = ['foo' => 'bar'];
        $request = new Request();
        $handler = Mockery::mock('Clearleft\SuperSharp\Handler\PassthruHandler');
        $handler->shouldReceive('handle')->once()->andReturn($params);

        $router = new Router($handler);
        $router->add('/foo', null, $params);
        $this->assertEquals($router->match('/foo'), $params);
    }

}