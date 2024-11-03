<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');


//CodeIgniter reads its routing rules from top to bottom and routes the request to the first matching rule. Each rule is a regular expression (left-side) mapped to a controller and method name (right-side). When a request comes in, CodeIgniter looks for the first match, and calls the appropriate controller and method, possibly with arguments.
use App\Controllers\UsuariosController;
$routes->get('form', [UsuariosController::class, 'index']);
$routes->post('form', [UsuariosController::class, 'index']);