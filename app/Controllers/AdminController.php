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

        $data = [
            'title' => 'Categorías'
        ];


        return view('admin/categories', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }

    public function subcategories()
    {
        // Es necesario para el uso de set_value() en las vistas!
        helper('form');

        $data = [
            'title' => 'Panel de administración'
        ];


        return view('admin/show', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }

    public function topics()
    {
        // Es necesario para el uso de set_value() en las vistas!
        helper('form');

        $data = [
            'title' => 'Panel de administración'
        ];


        return view('admin/show', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
    }

    public function users()
    {
        // Es necesario para el uso de set_value() en las vistas!
        helper('form');

        $data = [
            'title' => 'Panel de administración'
        ];


        return view('admin/show', $data);
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
