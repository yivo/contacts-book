<?php

namespace Plus33FPS\HTTP;

class Request {

    protected $_serverVar;
    protected $_getVar;
    protected $_postVar;

    public function __construct($serverVar, $getVar, $postVar) {
        $this->_serverVar   = $serverVar;
        $this->_postVar     = $postVar;
        $this->_getVar      = $getVar;
    }

    public function getURI($preserveQueryParams = false) {
        $uri = $this->_serverVar['REQUEST_URI'];

        if ($preserveQueryParams) {
            return $uri;
        } else {
            $pos = strrpos($uri, '?');
            if ($pos !== false) {
                $uri = substr($uri, 0, $pos);
            }
            return $uri;
        }
    }

    public function getQueryString() {
        # TODO Implement
    }

    public function getMethod() {
        return $this->_serverVar['REQUEST_METHOD'];
    }

    public function isPOST() {
        return $this->getMethod() === 'POST';
    }

    public function isGET() {
        return $this->getMethod() === 'GET';
    }

    public function getAllParams() {
        return array_merge($this->getGETParams(), $this->getPOSTParams());
    }

    public function getPOSTParams() {
        return $this->_postVar;
    }

    public function getGETParams() {
        return $this->_getVar;
    }
}