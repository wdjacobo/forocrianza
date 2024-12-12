<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class AdminController extends BaseController
{

    /**
     * Lanza excepciones que son páginas de error 404 relacionadas con rutas no encontradas en el área de administración.
     * 
     * Diferencia entre usuarios autorizados como administradores y no autorizados, para no dar pistas.
     *
     * @throws PageNotFoundException En cualquier caso
     * 
     * @return void No retorna nada
     */
    public function adminNotFound(): void
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        throw new PageNotFoundException('No se ha podido encontrar esta dirección en el área de administración, ¡Que venga el encargao!');
    }


    /**
     * Añade un usuario al grupo de admin.
     * 
     * @param int|string $userId ID del usuario que se añadirá como admin.
     * 
     * @return RedirectResponse a la página anterior con un mensaje de éxito.
     * 
     */
    public function includeInAdminGroup($userId): RedirectResponse
    {
        $usersModel = auth()->getProvider();
        $user = $usersModel->find($userId);
        $user->addGroup('admin');
        return redirect()->back()->with('success', $user->username . ' ahora pertenece al grupo admin.');
    }

    /**
     * Elimina a un usuario del grupo de admin.
     * 
     * @param int|string $userId ID del usuario que se añadirá como admin.
     * 
     * @return RedirectResponse a la página anterior con un mensaje de éxito.
     * 
     */
    public function removeFromAdminGroup($userId)
    {
        $usersModel = auth()->getProvider();
        $user = $usersModel->find($userId);
        $user->removeGroup('admin');
        return redirect()->back()->with('success', $user->username . ' ya no pertenece al grupo admin.');
    }
}
