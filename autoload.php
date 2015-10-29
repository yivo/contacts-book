<?php

define('ROOT_DIR', __DIR__);

function autoload_processor($className) {
    // Library\Configuration
    require_once ROOT_DIR . '/' . str_replace('\\', '/', $className) . '.php';
}

spl_autoload_register('autoload_processor');