<?php namespace Amu\SuperSharp\Handler;

use Amu\SuperSharp\Http\Request;

interface HandlerInterface
{
    public function handle($params, Request $request);
}