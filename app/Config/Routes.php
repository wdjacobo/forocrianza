<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//CodeIgniter reads its routing rules from top to bottom and routes the request to the first matching rule. Each rule is a regular expression (left-side) mapped to a controller and method name (right-side). When a request comes in, CodeIgniter looks for the first match, and calls the appropriate controller and method, possibly with arguments.
use App\Controllers\UsersController;
use App\Controllers\MainController;

$routes->get('usuarios', [UsersController::class, 'index']);
$routes->get('usuarios/<:segment>', [UsersController::class, 'mostrar']);

$routes->get('registro', [MainController::class, 'registro']);
$routes->get('iniciar-sesion', [MainController::class, 'iniciar_sesion']);
$routes->get('/', [MainController::class, 'inicio']);
$routes->get('subcategoria', [MainController::class, 'subcategoria']);
$routes->get('tema', [MainController::class, 'tema']);
$routes->get('perfil', [MainController::class, 'perfil']);
$routes->get('admin', [MainController::class, 'admin']);
$routes->get('blog', [MainController::class, 'blog']);
$routes->get('blog-post', [MainController::class, 'blog_post']);

service('auth')->routes($routes);