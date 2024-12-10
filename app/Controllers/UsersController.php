<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Shield\Entities\User;

class UsersController extends BaseController
{


    public function index()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        $usersModel = auth()->getProvider();
        $users = $usersModel->orderBy('username')->findAll();
        // Tranformamos cada instancia de usuario a arrays para mantener la coherencia con el resto de la aplicación
        // Ver Example #2 https://www.php.net/manual/en/function.array-map.php
        $usersArray = array_map(fn($user) => $user->toArray(), $users);

        $data = [
            'title' => 'Usuarios',
            'users' => $usersArray,
        ];

        return view('templates/adminHeaderTemplate', $data)
            . view('templates/adminAsideTemplate')
            . view('users/index')
            . view('templates/adminFooterTemplate');
    }


    public function patch()
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


    /**
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function update()
    {
        $users = auth()->getProvider();

        $user = new User([
            'username' => 'nuevoUsuario',
            'email'    => 'correo@ejemplo.com',
            'password' => 'contraseña123',
        ]);

        $users->save($user);
        $user = $users->findById($users->getInsertID());

        $users->addToDefaultGroup($user);
    }

    public function delete($userId)
    {
        if (auth()->id() == $userId) {
            return redirect()->to('admin/usuarios')->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $usersModel = auth()->getProvider();

        try {
            $usersModel->delete($userId);
            return redirect()->to('admin/usuarios')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->to('admin/usuarios')->with('error', 'Se produjo un error al eliminar al usuario y no se pudo realizar la acción. Inténtalo de nuevo.');
        }
    }

    /**
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function _delete()
    {
        $users = auth()->getProvider();

        $user = new User([
            'username' => 'nuevoUsuario',
            'email'    => 'correo@ejemplo.com',
            'password' => 'contraseña123',
        ]);

        $users->save($user);
        $user = $users->findById($users->getInsertID());

        $users->addToDefaultGroup($user);
    }
}
