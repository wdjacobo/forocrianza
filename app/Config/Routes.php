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
$routes->get('nuevo-tema', [MainController::class, 'nuevo_tema']);
$routes->get('subcategoria', [MainController::class, 'subcategoria']);
$routes->get('tema', [MainController::class, 'tema']);
$routes->get('perfil', [MainController::class, 'perfil']);
$routes->get('admin', [MainController::class, 'admin']);
$routes->get('admin-dash', [MainController::class, 'admin_dash'], ['filter' => 'session']); # Añadirmos el filtro de sesión de este modo para requerir que el usuario deba estar logueado para acceder a la ruta.
$routes->get('quill', [MainController::class, 'quill']);
$routes->get('debug', [MainController::class, 'debug']);

#$routes->get('/iniciar-sesion', 'AuthController::login', ['as' => 'login']);
#$routes->get('/registro', 'AuthController::register', ['as' => 'register']);


# Routes Setup: The default auth routes can be setup with a single call in app/Config/Routes.php
# Rutas establecidas por Shield para login y resgistro, ver routes en Auth (en vendor>codeigniter4...) y AuthRoutes.php
service('auth')->routes($routes);


# En principio no voy a añadir el blog
/* $routes->get('blog', [MainController::class, 'blog']);
$routes->get('blog-post', [MainController::class, 'blog_post']); */


# Otra forma de hacerlo, de poner nombre con as? Es distinto? Útil para redirects o no?
$routes->get('debug', 'MainController::debug', ['as' => 'debug']);