<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;
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
        foreach ($usersArray as &$user) {
            $user['isAdmin'] = false;
            $currentUser = $usersModel->find($user['id']);
            if ($currentUser->inGroup('admin')) {
                $user['isAdmin'] = true;
            }
        }

        $data = [
            'title' => 'Usuarios',
            'users' => $usersArray,
        ];

        return view('templates/adminHeaderTemplate', $data)
            . view('templates/adminAsideTemplate')
            . view('users/index')
            . view('templates/adminFooterTemplate');
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


    public function patch()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        // Ojo, aquí usaremos el user Provider
        $usersModel = auth()->getProvider();

        $users = $usersModel->orderBy('username')->findAll();

        $usersArray = array_map(fn($user) => $user->toArray(), $users);

        $data = [
            'title' => 'Usuarios',
            'users' => $usersArray,
        ];


        return view('admin/users', $data);
    }


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
}
