<?php namespace Clearleft\SuperSharp\Handler;

use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

use Clearleft\SuperSharp\Exception\Exception;
use Clearleft\SuperSharp\Http\Request;
use Clearleft\SuperSharp\Handler\HandlerInterface;

class CallableHandler implements HandlerInterface
{
    public function handle($params, Request $request)
    {
        if (empty($params['_controller'])) {
            throw new Exception('The CallableHandler requires a non-empty controller value');
        }
        $resolver = new ControllerResolver();
        $request->attributes->add($params);
        $controller = $resolver->getController($request);
        $arguments = $resolver->getArguments($request, $controller);
        return call_user_func_array($controller, $arguments);
    }
}