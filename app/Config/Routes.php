<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\MainController;
use App\Controllers\LegalController;
use App\Controllers\SubcategoriesController;
use App\Controllers\CategoriesController;
use App\Controllers\TopicsController;
use App\Controllers\ProfileController;
use App\Controllers\AdminController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [MainController::class, 'index'], ['as' => 'index']);



//Bien
//if (auth()->loggedIn()) {}
$routes->get('aviso-legal', [LegalController::class, 'showLegalNotice'], ['as' => 'legal-notice']);
$routes->get('politica-de-cookies', [LegalController::class, 'showCookiesPolicy'], ['as' => 'cookies-policy']);
$routes->get('politica-de-privacidad', [LegalController::class, 'showPrivacyPolicy'], ['as' => 'privacy-policy']);




// Refactorizar

//Temas
$routes->match(['get', 'post'], '/crear-tema', [TopicsController::class, 'create'], ['as' => 'create-topic']);


// Categorías
$routes->get('admin/categorias', [CategoriesController::class, 'index'], ['as' => 'categories']);
$routes->match(['get', 'post'], 'admin/crear-categoria', [CategoriesController::class, 'create'], ['as' => 'create-category']);
$routes->match(['get', 'patch'], 'admin/editar-categoria/(:segment)', [CategoriesController::class, 'patch'], ['as' => 'edit-category']);
$routes->delete('admin/eliminar-categoria/(:segment)', [CategoriesController::class, 'delete'], ['as' => 'delete-category']);

// Subcategorías
$routes->get('admin/subcategorias', [SubcategoriesController::class, 'index'], ['as' => 'subcategories']);
$routes->match(['get', 'post'], 'admin/crear-categoria', [SubcategoriesController::class, 'create'], ['as' => 'create-subcategory']);
$routes->match(['get', 'patch'], 'admin/editar-categoria/(:segment)', [SubcategoriesController::class, 'patch'], ['as' => 'edit-subcategory']);
$routes->delete('admin/eliminar-categoria/(:segment)', [SubcategoriesController::class, 'delete'], ['as' => 'delete-subcategory']);

// Temas
$routes->get('admin/temas', [TopicsController::class, 'index'], ['as' => 'topics']);
$routes->delete('admin/eliminar-tema/(:segment)', [TopicsController::class, 'delete'], ['as' => 'delete-topic']);

// Usuarios
$routes->get('admin/usuarios', [AdminController::class, 'showUsers'], ['as' => 'users']);
$routes->match(['get', 'patch'], 'admin/editar-usuario/(:segment)', [AdminController::class, 'patchUser'], ['as' => 'edit-user']);
$routes->delete('admin/eliminar-usuario/(:segment)', [AdminController::class, 'deleteUser'], ['as' => 'delete-user']);


$routes->get('admin/(:segment)', [AdminController::class, 'adminNotFound']);

# Routes Setup: The default auth routes can be setup with a single call in app/Config/Routes.php
# Rutas establecidas por Shield para login y registro
service('auth')->routes($routes, ['except' => ['magic-link']]);


# En principio no voy a añadir el blog
/* $routes->get('blog', [MainController::class, 'blog']);
$routes->get('blog-post', [MainController::class, 'blog_post']); */

$routes->get('/perfil/(:segment)', [ProfileController::class, 'show'], ['as' => 'profile']);
$routes->get('/01001101-01101001-01110011-01101000-01101001-01101101-01101001-01110011-01101000-01101001', [MainController::class, 'interview']);
$routes->get('/(:segment)', [SubcategoriesController::class, 'show'], ['as' => 'subcategory']);
$routes->get('/(:segment)/(:segment)', [TopicsController::class, 'show'], ['as' => 'topic']);
$routes->get('/(:segment)/(:segment)/(:any)', [AdminController::class, 'notFound']);




//TODO: ordenar por orden alfabetico de controlador.
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
// Redirect to a named route
//$routes->addRedirect('/ruta', 'ruta a ir');
