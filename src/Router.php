<?php namespace Clearleft\SuperSharp;

use Clearleft\SuperSharp\Route;
use Clearleft\SuperSharp\Match;
use Clearleft\SuperSharp\Http\Request;
use Clearleft\SuperSharp\Handlers\HandlerInterface;
use Clearleft\SuperSharp\Handlers\CallableHandler;
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

    public function add($pattern, $args = null)
    {
        $route = clone $this->defaultRoute;
        $route->setPath($pattern);
        $route->setDefault('_args', $args);
        $this->routes[] = $route;
        return $route;
    }

    public function get($pattern, $args = null)
    {
        return $this->add($pattern, $args)->method('GET');
    }

    public function post($pattern, $args = null)
    {
        return $this->add($pattern, $args)->method('POST');
    }

    public function put($pattern, $args = null)
    {
        return $this->add($pattern, $args)->method('PUT');
    }

    public function delete($pattern, $args = null)
    {
        return $this->add($pattern, $args)->method('DELETE');
    }

    public function patch($pattern, $args = null)
    {
        return $this->add($pattern, $args)->method('PATCH');
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