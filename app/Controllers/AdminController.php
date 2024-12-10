<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class AdminController extends BaseController
{
    public function categories()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }
        // Es necesario para el uso de set_value() en las vistas!
        helper('form');


        $categoriesModel = model('CategoriesModel');

        $data = [
            'title' => 'Categorías',
            'categories' => $categoriesModel->orderBy('title')->findAll(),
        ];


        return view('admin/categories', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }

    public function subcategories()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        // Es necesario para el uso de set_value() en las vistas!
        helper('form');

        $subcategoriesModel = model('SubcategoriesModel');

        $data = [
            'title' => 'Subcategorías',
            'subcategories' => $subcategoriesModel->orderBy('title')->findAll(),
        ];


        return view('admin/subcategories', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }

    public function topics()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        // Es necesario para el uso de set_value() en las vistas!
        helper('form');

        $topicsModel = model('TopicsModel');

        $data = [
            'title' => 'Temas',
            'topics' => $topicsModel->orderBy('title')->findAll(),
        ];

        return view('admin/topics', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }

    public function users()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }
        // Es necesario para el uso de set_value() en las vistas!
        helper('form');


        // Ojo, aquí usaremos el user Provider
        //$topicsModel = model('TopicsModel');
        // El proveedor de usuarios por defecto, UserModel
        $usersModel = auth()->getProvider();

        $users = $usersModel->orderBy('username')->findAll();

        // Tranformamos cada instancia de usuario a arrays para mantener la coherencia con el resto de la aplicación
        // Ver Example #2 https://www.php.net/manual/en/function.array-map.php
        $usersArray = array_map(fn($user) => $user->toArray(), $users);

        $data = [
            'title' => 'Usuarios',
            'users' => $usersArray,
        ];


        return view('admin/users', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }



    public function notFound()
    {
        throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
    }

    public function adminNotFound()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        throw new PageNotFoundException('No se ha podido encontrar esta dirección en el area de administración, ¡Que venga el encargao!');
    }
}
