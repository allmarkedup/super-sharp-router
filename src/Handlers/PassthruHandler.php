<?php namespace Clearleft\SuperSharp\Handlers;

use Clearleft\SuperSharp\Http\Request;
use Clearleft\SuperSharp\Handlers\HandlerInterface;

class PassthruHandler implements HandlerInterface
{
    public function handle($params, Request $request)
    {
        return $params;
    }
}