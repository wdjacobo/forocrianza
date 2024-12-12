<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class AdminController extends BaseController
{

    public function adminNotFound()
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        throw new PageNotFoundException('No se ha podido encontrar esta dirección en el area de administración, ¡Que venga el encargao!');
    }


    public function includeInAdminGroup($userId)
    {
        $usersModel = auth()->getProvider();
        $user = $usersModel->find($userId);
        $user->addGroup('admin');
        return redirect()->back()->with('success', $user->username . ' ahora pertenece al grupo admin.');
    }

    public function removeFromAdminGroup($userId)
    {
        $usersModel = auth()->getProvider();
        $user = $usersModel->find($userId);
        $user->removeGroup('admin');
        return redirect()->back()->with('success', $user->username . ' ya no pertenece al grupo admin.');
    }
}
