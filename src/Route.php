<?php namespace Amu\SuperSharp;

use Symfony\Component\Routing\Route as SymfonyRoute;

class Route extends SymfonyRoute
{
    protected $routeName = null;

    public function __construct($path = '/', array $defaults = array(), array $requirements = array(), array $options = array(), $host = '', $schemes = array(), $methods = array())
    {
        parent::__construct($path, $defaults, $requirements, $options, $host, $schemes, $methods);
    }

    public function assert($variable, $regexp)
    {
        $this->setRequirement($variable, $regexp);
        return $this;
    }

    public function value($variable, $default)
    {
        $this->setDefault($variable, $default);
        return $this;
    }

    public function method($method)
    {
        $this->setMethods(explode('|', $method));
        return $this;
    }

    public function host($host)
    {
        $this->setHost($host);
        return $this;
    }

    public function requireHttp()
    {
        $this->setSchemes('http');
        return $this;
    }

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
        
        $routeName = $method.$this->getPath();
        $routeName = str_replace(array('/', ':', '|', '-'), '_', $routeName);
        $routeName = preg_replace('/[^a-z0-9A-Z_.]+/', '', $routeName);

        return $routeName;
    }
    
}
