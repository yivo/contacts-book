<?php
namespace Plus33FPS\Routing;

class Route {
    protected $_name;
    protected $_pattern;
    protected $_controller;
    protected $_action;

    public function __construct($options) {
        $this->_name        = $options['name'];
        $this->_pattern     = $options['pattern'];
        $this->_controller  = @$options['controller'];
        $this->_action      = @$options['action'];
    }

    public function getName() {
        return $this->_name;
    }

    public function getPattern() {
        return $this->_pattern;
    }

    public function getController() {
        return $this->_controller;
    }

    public function getAction() {
        return $this->_action;
    }
}