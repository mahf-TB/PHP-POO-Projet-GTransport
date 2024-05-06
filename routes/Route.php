<?php

namespace Router;

class Route
{
    public $path;
    public $action;
    public $matches;
    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches($url)
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;    
            return true;
        } else {
            return false;
        }
    }

    public function executeAction()
    {
        $parts = explode('@', $this->action);
        $controllerName = $parts[0];
        $methodName = $parts[1];
        $controller = new $controllerName();

        if (isset($this->matches[1])) {
           return $controller->$methodName($this->matches[1]);
        } else {
            return $controller->$methodName();
        }
        
    }
}
