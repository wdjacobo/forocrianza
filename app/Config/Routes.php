<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//CodeIgniter reads its routing rules from top to bottom and routes the request to the first matching rule. Each rule is a regular expression (left-side) mapped to a controller and method name (right-side). When a request comes in, CodeIgniter looks for the first match, and calls the appropriate controller and method, possibly with arguments.
use App\Controllers\UsersController;
use App\Controllers\MainController;


// prueba BD
//$routes->get('usuarios', [UsersController::class, 'index']);
//$routes->get('usuarios/<:segment>', [UsersController::class, 'mostrar']);

$routes->get('registro', [MainController::class, 'registro'], ['as' => 'registro']);
$routes->get('iniciar-sesion', [MainController::class, 'iniciar_sesion'], ['as' => 'iniciar-sesion']);
$routes->get('/', [MainController::class, 'inicio'], ['as' => 'inicio']);
$routes->get('nuevo-tema', [MainController::class, 'nuevo_tema'], ['as' => 'nuevo-tema']);
$routes->get('subcategoria', [MainController::class, 'subcategoria'], ['as' => 'subcategoria']);
$routes->get('tema', [MainController::class, 'tema'], ['as' => 'tema']);
$routes->get('perfil', [MainController::class, 'perfil'], ['as' => 'perfil']);
$routes->get('admin', [MainController::class, 'admin'], ['as' => 'admin', 'filter' => 'session']);
$routes->get('admin-dash', [MainController::class, 'admin_dash'], ['as' => 'adminazo', 'filter' => 'session']); # Añadirmos el filtro de sesión de este modo para requerir que el usuario deba estar logueado para acceder a la ruta.
$routes->get('quill', [MainController::class, 'quill'], ['as' => 'quill']);
$routes->get('debug', [MainController::class, 'debug'], ['as' => 'debug']);
$routes->get('redirect', [MainController::class, 'redirect'], ['as' => 'redirect']);

#$routes->get('/iniciar-sesion', 'AuthController::login', ['as' => 'login']);
#$routes->get('/registro', 'AuthController::register', ['as' => 'register']);


# Routes Setup: The default auth routes can be setup with a single call in app/Config/Routes.php
# Rutas establecidas por Shield para login y resgistro, ver routes en Auth (en vendor>codeigniter4...) y AuthRoutes.php
service('auth')->routes($routes, ['except' => ['magic-link']]); // Habría que meter más en el except...


# En principio no voy a añadir el blog
/* $routes->get('blog', [MainController::class, 'blog']);
$routes->get('blog-post', [MainController::class, 'blog_post']); */