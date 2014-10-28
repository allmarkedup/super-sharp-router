<?php namespace Clearleft\SuperSharp\Handlers;

use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

use Clearleft\SuperSharp\Http\Request;
use Clearleft\SuperSharp\Handlers\HandlerInterface;

class CallableHandler implements HandlerInterface
{
    public function handle($params, Request $request)
    {
        $resolver = new ControllerResolver();
        $params['_controller'] = $params['_args'];
        $request->attributes->add($params);
        $controller = $resolver->getController($request);
        $arguments = $resolver->getArguments($request, $controller);
        return call_user_func_array($controller, $arguments);
    }
}