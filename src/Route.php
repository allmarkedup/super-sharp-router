<?php namespace Clearleft\SuperSharp;

use Symfony\Component\Routing\Route as SymfonyRoute;

class Route extends SymfonyRoute
{
    protected $routeName = null;

    /**
     * Constructor.
     *
     * @param string       $path         The path pattern to match
     * @param array        $defaults     An array of default parameter values
     * @param array        $requirements An array of requirements for parameters (regexes)
     * @param array        $options      An array of options
     * @param string       $host         The host pattern to match
     * @param string|array $schemes      A required URI scheme or an array of restricted schemes
     * @param string|array $methods      A required HTTP method or an array of restricted methods
     */
    public function __construct($path = '/', array $defaults = array(), array $requirements = array(), array $options = array(), $host = '', $schemes = array(), $methods = array())
    {
        // overridden constructor to make $path optional
        parent::__construct($path, $defaults, $requirements, $options, $host, $schemes, $methods);
    }

    /**
     * Sets the requirement for a route variable.
     *
     * @param string $variable The variable name
     * @param string $regexp   The regexp to apply
     *
     * @return Route $this The current route instance
     */
    public function assert($variable, $regexp)
    {
        $this->setRequirement($variable, $regexp);

        return $this;
    }

    /**
     * Sets the default value for a route variable.
     *
     * @param string $variable The variable name
     * @param mixed  $default  The default value
     *
     * @return Route $this The current Route instance
     */
    public function value($variable, $default)
    {
        $this->setDefault($variable, $default);

        return $this;
    }

    /**
     * Sets the requirement for the HTTP method.
     *
     * @param string $method The HTTP method name. Multiple methods can be supplied, delimited by a pipe character '|', eg. 'GET|POST'
     *
     * @return Route $this The current Route instance
     */
    public function method($method)
    {
        $this->setMethods(explode('|', $method));

        return $this;
    }

    /**
     * Sets the requirement of host on this Route.
     *
     * @param string $host The host for which this route should be enabled
     *
     * @return Route $this The current Route instance
     */
    public function host($host)
    {
        $this->setHost($host);

        return $this;
    }

    /**
     * Sets the requirement of HTTP (no HTTPS) on this Route.
     *
     * @return Route $this The current Route instance
     */
    public function requireHttp()
    {
        $this->setSchemes('http');

        return $this;
    }

    /**
     * Sets the requirement of HTTPS on this Route.
     *
     * @return Route $this The current Route instance
     */
    public function requireHttps()
    {
        $this->setSchemes('https');

        return $this;
    }

    public function name($name)
    {
        $this->routeName = $name;
        
        return $this;
    }

    public function getName()
    {
        return $this->routeName ?: $this->generateName();
    }

    protected function generateName()
    {
        $requirements = $this->getRequirements();
        $method = isset($requirements['_method']) ? $requirements['_method'] : '';
        
        $routeName = $prefix.$method.$this->getPath();
        $routeName = str_replace(array('/', ':', '|', '-'), '_', $routeName);
        $routeName = preg_replace('/[^a-z0-9A-Z_.]+/', '', $routeName);

        return $routeName;
    }
    
}
