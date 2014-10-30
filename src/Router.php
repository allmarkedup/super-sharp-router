<?php namespace Amu\SuperSharp;

use Amu\SuperSharp\Route;
use Amu\SuperSharp\Match;
use Amu\SuperSharp\Http\Request;
use Amu\SuperSharp\Handler\HandlerInterface;
use Amu\SuperSharp\Handler\CallableHandler;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    protected $routes;

    protected $defaultRoute;

    protected $handler;

    protected $context;

    public function __construct(HandlerInterface $handler = null)
    {
        $this->routes = [];
        $this->defaultRoute = new Route();
        $this->context = new RequestContext();
        $this->context->fromRequest(Request::createFromGlobals());
        $this->handler = $handler ?: new CallableHandler();
    }

    public function match($urlOrRequest = null)
    {
        $request = $this->makeRequest($urlOrRequest);
        $matcher = new UrlMatcher($this->getRoutes(), $this->context);
        $params = $matcher->matchRequest($request);
        return $this->handler->handle($params, $request);
    }

    public function add($pattern, $controller = null, array $args = null)
    {
        $args = $args ?: [];
        $route = clone $this->defaultRoute;
        $route->setPath($pattern);
        $route->setDefault('_controller', $controller);
        $route->setDefault('_args', $args);
        $this->routes[] = $route;
        return $route;
    }

    public function get($pattern, $controller = null, array $args = null)
    {
        return $this->add($pattern, $controller , $args)->method('GET');
    }

    public function post($pattern, $controller = null, array $args = null)
    {
        return $this->add($pattern, $controller , $args)->method('POST');
    }

    public function put($pattern, $controller = null, array $args = null)
    {
        return $this->add($pattern, $controller , $args)->method('PUT');
    }

    public function delete($pattern, $controller = null, array $args = null)
    {
        return $this->add($pattern, $controller , $args)->method('DELETE');
    }

    public function patch($pattern, $controller = null, array $args = null)
    {
        return $this->add($pattern, $controller , $args)->method('PATCH');
    }

    protected function makeRequest($urlOrRequest)
    {
        $urlOrRequest = $urlOrRequest ?: Request::createFromGlobals();
        return ($urlOrRequest instanceof Request) ? $urlOrRequest : Request::create($urlOrRequest);
    }

    protected function getRoutes()
    {
        $collection = new RouteCollection();
        foreach ($this->routes as $route) {
            $collection->add($route->getName(), $route);
        }
        return $collection;
    }

}