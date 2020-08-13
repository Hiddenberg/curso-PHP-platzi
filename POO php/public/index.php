<?php

ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

require_once '..\vendor\autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use App\models\Job;
use App\models\Project;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
   $_SERVER,
   $_GET,
   $_POST,
   $_COOKIE,
   $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('index', '/', [
   'controller' => 'App\Controllers\IndexController',
   'action' => 'indexAction'
]);
$map->get('addJobs', '/jobs/add', [
   'controller' => 'App\Controllers\JobsController',
   'action' => 'getAddJobAction'
]);
$map->post('saveJobs', '/jobs/add', [
   'controller' => 'App\Controllers\JobsController',
   'action' => 'getAddJobAction'
]);
$map->get('addUser', '/user/add', [
   'controller' => 'App\Controllers\UsersController',
   'action' => 'getAddUserAction'
]);
$map->post('saveUser', '/user/add', [
   'controller' => 'App\Controllers\UsersController',
   'action' => 'getAddUserAction'
]);
$map->get('loginUser', '/user/login', [
   'controller' => 'App\Controllers\UsersController',
   'action' => 'getLoginUserAction'
]);
$map->post('accessGrantedUser', '/user/login', [
   'controller' => 'App\Controllers\UsersController',
   'action' => 'getLoginUserAction'
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if (!$route) {
   echo 'No route';
} else {
   $handlerData = $route->handler;
   $controllerName = $handlerData['controller'];
   $actionName = $handlerData ['action'];

   $controller = new $controllerName;
   $response = $controller->$actionName($request);

   echo $response->getBody();
}