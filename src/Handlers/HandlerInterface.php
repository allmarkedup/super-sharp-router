<?php namespace Clearleft\SuperSharp\Handlers;

use Clearleft\SuperSharp\Http\Request;

interface HandlerInterface
{
    public function handle($params, Request $request);
}