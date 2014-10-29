<?php namespace Clearleft\SuperSharp\Tests\Handler;

use Clearleft\SuperSharp\Handler\PassthruHandler;
use Clearleft\SuperSharp\Http\Request;

/**
 * @author Mark Perkins <mark@clearleft.com>
 */
class PassthruHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testParamsPassedThough()
    {
        $handler = new PassthruHandler();
        $params = [
            'foo' => 'bar',
            '_controller' => 'foobar'
        ];
        $this->assertEquals($handler->handle($params, new Request), $params);
    }

}