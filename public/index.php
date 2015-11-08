<?php

require __DIR__ . '/../autoload.php';

use Library\Configuration as Config;

Config::set('db.engine',         'mysql');
Config::set('db.user',           'root');
Config::set('db.password',       'root');
Config::set('db.host',           '127.0.0.1');
Config::set('db.name',           'contacts-book');

$request = new Plus33FPS\HTTP\Request($_SERVER, $_GET, $_POST);

$router = new Plus33FPS\Routing\Router($request);

$routeStore = new Plus33FPS\Routing\RouteStore();
$routeStore->add(new Plus33FPS\Routing\Route([
    'name'          => 'index',
    'pattern'       => '/^\/$/',
    'controller'    => 'App\Controllers\IndexController',
    'action'        => 'indexAction'
]));

$routeStore->add(new Plus33FPS\Routing\Route([
    'name'          => 'users.list',
    'pattern'       => '/^\/users$/',
    'controller'    => 'App\Controllers\UsersController',
    'action'        => 'indexAction'
]));

$routeStore->add(new Plus33FPS\Routing\Route([
    'name'          => 'users.show',
    'pattern'       => '/^\/users\/(\d+)$/',
    'controller'    => 'App\Controllers\UsersController',
    'action'        => 'showAction'
]));

/**
 * @var Plus33FPS\Routing\Route $route
 */
$route = $router->route($request, $routeStore->getAll());

$controllerClassName = $route->getController();

/**
 * @var \Plus33FPS\Controller $controllerInstance
 */
$controllerInstance = new $controllerClassName();
$controllerInstance->{$route->getAction()}();