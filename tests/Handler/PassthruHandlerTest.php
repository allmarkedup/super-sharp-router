<?php namespace Amu\SuperSharp\Tests\Handler;

use Amu\SuperSharp\Handler\PassthruHandler;
use Amu\SuperSharp\Http\Request;

/**
 * @author Mark Perkins <mark@Amu.com>
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