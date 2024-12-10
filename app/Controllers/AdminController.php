<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class AdminController extends BaseController
{

    


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
