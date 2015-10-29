<?php
namespace Plus33FPS\Routing;

class RouteStore {
    protected $_orderedRoutes;
    protected $_routesByName;

    public function __construct() {
        $this->_orderedRoutes = [];
        $this->_routesByName  = [];
    }

    public function add(Route $route) {
        array_push($this->_orderedRoutes, $route);
        $this->_routesByName[$route->getName()] = $route;
    }

    public function remove(Route $route) {
        # TODO Implement
    }

    public function get($name) {
        return $this->_routesByName[$name];
    }

    public function getAll() {
        return $this->_orderedRoutes;
    }
}