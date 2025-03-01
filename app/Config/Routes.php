<?php

use App\Controllers\AdminController;
use App\Controllers\CategoriesController;
use App\Controllers\LegalController;
use App\Controllers\MainController;
use App\Controllers\MessagesController;
use App\Controllers\ProfileController;
use App\Controllers\SubcategoriesController;
use App\Controllers\TopicsController;
use App\Controllers\UsersController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->get('/', [MainController::class, 'index'], ['as' => 'index']);



//Rutas de temas para usuario
$routes->match(['get', 'post'], '/crear-tema', [TopicsController::class, 'create'], ['as' => 'create-topic']);
$routes->delete('/eliminar-tema/(:segment)', [TopicsController::class, 'delete'], ['as' => 'delete-topic']);



//Rutas de mensajes para usuario
$routes->post('/crear-mensaje/(:segment)', [MessagesController::class, 'create'], ['as' => 'create-message']);
$routes->delete('/eliminar-mensaje/(:segment)', [MessagesController::class, 'delete'], ['as' => 'delete-message']);



// RUTAS DEL PANEL DE ADMINISTRACIÓN

// Categorías
$routes->get('admin/categorias', [CategoriesController::class, 'index'], ['as' => 'categories', 'filter' => 'group:admin']);
$routes->match(['get', 'post'], 'admin/crear-categoria', [CategoriesController::class, 'create'], ['as' => 'create-category', 'filter' => 'group:admin']);
$routes->match(['get', 'patch'], 'admin/editar-categoria/(:segment)', [CategoriesController::class, 'patch'], ['as' => 'edit-category', 'filter' => 'group:admin']);
$routes->delete('admin/eliminar-categoria/(:segment)', [CategoriesController::class, 'delete'], ['as' => 'delete-category', 'filter' => 'group:admin']);

// Subcategorías
$routes->get('admin/subcategorias', [SubcategoriesController::class, 'index'], ['as' => 'subcategories', 'filter' => 'group:admin']);
$routes->match(['get', 'post'], 'admin/crear-subcategoria', [SubcategoriesController::class, 'create'], ['as' => 'create-subcategory', 'filter' => 'group:admin']);
$routes->match(['get', 'patch'], 'admin/editar-subcategoria/(:segment)', [SubcategoriesController::class, 'patch'], ['as' => 'edit-subcategory', 'filter' => 'group:admin']);
$routes->delete('admin/eliminar-subcategoria/(:segment)', [SubcategoriesController::class, 'delete'], ['as' => 'delete-subcategory', 'filter' => 'group:admin']);

// Temas
$routes->get('admin/temas', [TopicsController::class, 'index'], ['as' => 'topics', 'filter' => 'group:admin']);
$routes->delete('admin/eliminar-tema/(:segment)', [TopicsController::class, 'adminDelete'], ['as' => 'admin-delete-topic', 'filter' => 'group:admin']);

// Usuarios
$routes->get('admin/usuarios', [UsersController::class, 'index'], ['as' => 'users', 'filter' => 'group:admin']);
$routes->get('admin/incluir-admin/(:segment)', [AdminController::class, 'includeInAdminGroup'], ['as' => 'include-admin', 'filter' => 'group:admin']);
$routes->get('admin/eliminar-admin/(:segment)', [AdminController::class, 'removeFromAdminGroup'], ['as' => 'remove-admin', 'filter' => 'group:admin']);
$routes->delete('admin/eliminar-usuario/(:segment)', [UsersController::class, 'delete'], ['as' => 'delete-user', 'filter' => 'group:admin']);

// Ruta falsa de "subcategoría admin no encontrada"
$routes->get('admin/(:segment)', [AdminController::class, 'adminNotFound']);



// Rutas de información legal
$routes->get('aviso-legal', [LegalController::class, 'showLegalNotice'], ['as' => 'legal-notice']);
$routes->get('politica-de-cookies', [LegalController::class, 'showCookiesPolicy'], ['as' => 'cookies-policy']);
$routes->get('politica-de-privacidad', [LegalController::class, 'showPrivacyPolicy'], ['as' => 'privacy-policy']);



// Rutas establecidas por Shield (necesarias para login, logout y registro)
service('auth')->routes($routes, ['except' => ['magic-link']]);




// Rutas que tienen que ir al final para no colisionar con otras
$routes->get('/perfil/(:segment)', [ProfileController::class, 'index'], ['as' => 'profile']);
$routes->get('/01001101-01101001-01110011-01101000-01101001-01101101-01101001-01110011-01101000-01101001', [MainController::class, 'interview']);
$routes->get('/(:segment)', [SubcategoriesController::class, 'show'], ['as' => 'subcategory']);
$routes->get('/(:segment)/(:segment)', [TopicsController::class, 'show'], ['as' => 'topic']);
$routes->get('/(:segment)/(:segment)/(:any)', [MainController::class, 'notFound']);
