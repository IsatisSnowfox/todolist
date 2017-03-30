<?php
session_start();
require 'configs/routes.php';

$default_route = $routes['default'];
$route_parts = explode('/', $default_route);
$method = $_SERVER['REQUEST_METHOD'];
$ressource = $_REQUEST['ressource'] ?? $route_parts[1];
$action = $_REQUEST['action'] ?? $route_parts[2];
var_dump($method . '/' . $ressource . '/' . $action);
if(!in_array($method . '/' . $ressource . '/' . $action, $routes)) {
    die('Nope haha'); // Faire la redirection
}

$controllerFile = $ressource . 'Controller.php';
require 'controllers/' . $controllerFile;
$datas = call_user_func($action);
