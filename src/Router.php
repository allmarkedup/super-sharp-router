<?php namespace Clearleft\SuperSharp;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

use Clearleft\SuperSharp\Route;
use Clearleft\SuperSharp\Http\Request;

class Router
{
    protected $routes;

    protected $defaultRoute;

    public function __construct()
    {
        $this->routes = [];
        $this->defaultRoute = new Route();
    }

    public function match($urlOrRequest = null)
    {
        $urlOrRequest = $urlOrRequest ?: Request::createFromGlobals();
        $routes = $this->getRoutes();
        $context = new RequestContext();
        $context->fromRequest(Request::createFromGlobals());
        $matcher = new UrlMatcher($routes, $context);
        
        $matchType = ($urlOrRequest instanceof SymfonyRequest) ? 'addRequest' : 'match';

        return $matcher->{$matchType}($urlOrRequest);
    }

    public function add($pattern, $to = null)
    {
        $route = clone $this->defaultRoute;
        $route->setPath($pattern);
        $route->setDefault('_controller', $to ?: null);
        $this->routes[] = $route;
        return $route;
    }

        /**
     * Maps a GET request to a callable.
     *
     * @param string $pattern added route pattern
     * @param mixed  $to      Callback that returns the response when added
     *
     * @return Controller
     */
    public function get($pattern, $to = null)
    {
        return $this->add($pattern, $to)->method('GET');
    }

    /**
     * Maps a POST request to a callable.
     *
     * @param string $pattern added route pattern
     * @param mixed  $to      Callback that returns the response when added
     *
     * @return Controller
     */
    public function post($pattern, $to = null)
    {
        return $this->add($pattern, $to)->method('POST');
    }

    /**
     * Maps a PUT request to a callable.
     *
     * @param string $pattern added route pattern
     * @param mixed  $to      Callback that returns the response when added
     *
     * @return Controller
     */
    public function put($pattern, $to = null)
    {
        return $this->add($pattern, $to)->method('PUT');
    }

    /**
     * Maps a DELETE request to a callable.
     *
     * @param string $pattern added route pattern
     * @param mixed  $to      Callback that returns the response when added
     *
     * @return Controller
     */
    public function delete($pattern, $to = null)
    {
        return $this->add($pattern, $to)->method('DELETE');
    }

    /**
     * Maps a PATCH request to a callable.
     *
     * @param string $pattern added route pattern
     * @param mixed  $to      Callback that returns the response when added
     *
     * @return Controller
     */
    public function patch($pattern, $to = null)
    {
        return $this->add($pattern, $to)->method('PATCH');
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