<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\MainController;
use App\Controllers\DebugController;
use App\Controllers\IndexController;
use App\Controllers\LegalController;
use App\Controllers\SubcategoriesController;
use App\Controllers\TopicsController;
use App\Controllers\ProfileController;

/**
 * @var RouteCollection $routes
 */




// Ver: https://codeigniter.com/user_guide/incoming/routing.html

// Display routes : php spark routes

//CodeIgniter reads its routing rules from top to bottom and routes the request to the first matching rule.
//Each rule is a regular expression (left-side) mapped to a controller and method name (right-side). When a request comes in, CodeIgniter looks for the first match, and calls the appropriate controller and method, possibly with arguments.





//Usar group() para cuando varias rutas comienzan por el mismo inicio.
//ejemplo de varias rutas
//$routes->match(['GET', 'PUT'], 'products', 'Product::feature');
//$routes->get('product/(:num)/(:num)', 'Product::index/$2/$1');
//$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
//$routes->get('users/(:uuid)', 'Users::show/$1');
/* $routes->group('admin', ['filter' => 'myfilter1:config'], static function ($routes) {
    $routes->get('/', 'Admin\Admin::index');

    $routes->group('users', ['filter' => 'myfilter2:region'], static function ($routes) {
        $routes->get('list', 'Admin\Users::list');
    });
}); */
// 404 override: https://codeigniter.com/user_guide/incoming/routing.html#override


//TODO: ordenar por orden alfabetico de controlador.
$routes->get('/', [IndexController::class, 'index'], ['as' => 'index']); //Esta debe ser la ruta inicial, al contener únicamente la '/'
$routes->get('/registro', [MainController::class, 'registro'], ['as' => 'registro']); //cambiar por sign in
$routes->get('/iniciar-sesion', [MainController::class, 'iniciar_sesion'], ['as' => 'iniciar-sesion']); //cambiar por login


//Bien
$routes->get('aviso-legal', [LegalController::class, 'showLegalNotice'], ['as' => 'aviso-legal']);
$routes->get('politica-de-cookies', [LegalController::class, 'showCookiesPolicy'], ['as' => 'politica-de-cookies']);
$routes->get('politica-de-privacidad', [LegalController::class, 'showPrivacyPolicy'], ['as' => 'politica-de-privacidad']);




// Refactorizar
$routes->get('nuevo-tema', [MainController::class, 'nuevo_tema'], ['as' => 'nuevo-tema']);

$routes->get('admin', [MainController::class, 'admin'], ['as' => 'admin', 'filter' => 'session']);

$routes->get('admin-dash', [MainController::class, 'admin_dash'], ['as' => 'adminazo', 'filter' => 'session']); # Añadirmos el filtro de sesión de este modo para requerir que el usuario deba estar logueado para acceder a la ruta. Y para estar logueado como admin en concreto?





//Pruebas
$routes->get('quill', [MainController::class, 'quill'], ['as' => 'quill']);
$routes->get('debug', [DebugController::class, 'debug'], ['as' => 'debug']);
$routes->get('redirect', [MainController::class, 'redirect'], ['as' => 'redirect']);





//$routes->get('/', [MainController::class, 'inicio'], ['as' => 'inicio']);

// prueba BD
//$routes->get('usuarios', [UsersController::class, 'index']);
//$routes->get('usuarios/<:segment>', [UsersController::class, 'mostrar']);
// Redirect to a named route
//$routes->addRedirect('users/about', 'profile');
// Redirect to a URI
//$routes->addRedirect('users/about', 'users/profile');




#$routes->get('/iniciar-sesion', 'AuthController::login', ['as' => 'login']);
#$routes->get('/registro', 'AuthController::register', ['as' => 'register']);


# Routes Setup: The default auth routes can be setup with a single call in app/Config/Routes.php
# Rutas establecidas por Shield para login y resgistro, ver routes en Auth (en vendor>codeigniter4...) y AuthRoutes.php
service('auth')->routes($routes, ['except' => ['magic-link']]); // Habría que meter más en el except...


# En principio no voy a añadir el blog
/* $routes->get('blog', [MainController::class, 'blog']);
$routes->get('blog-post', [MainController::class, 'blog_post']); */

$routes->get('/perfil/(:segment)', [ProfileController::class, 'show'], ['as' => 'profile']);
$routes->get('/(:segment)', [SubcategoriesController::class, 'show'], ['as' => 'subcategory']);
$routes->get('/(:segment)/(:segment)', [TopicsController::class, 'show'], ['as' => 'topic']);
