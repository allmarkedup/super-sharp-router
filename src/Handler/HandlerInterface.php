<?php namespace Clearleft\SuperSharp\Handler;

use Clearleft\SuperSharp\Http\Request;

interface HandlerInterface
{
    public function handle($params, Request $request);
}