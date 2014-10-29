<?php namespace Clearleft\SuperSharp\Handler;

use Clearleft\SuperSharp\Http\Request;
use Clearleft\SuperSharp\Handler\HandlerInterface;

class PassthruHandler implements HandlerInterface
{
    public function handle($params, Request $request)
    {
        return $params;
    }
}