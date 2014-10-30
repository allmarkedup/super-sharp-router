<?php namespace Amu\SuperSharp\Handler;

use Amu\SuperSharp\Http\Request;
use Amu\SuperSharp\Handler\HandlerInterface;

class PassthruHandler implements HandlerInterface
{
    public function handle($params, Request $request)
    {
        return $params;
    }
}