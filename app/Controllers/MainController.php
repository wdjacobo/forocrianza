<?php

declare(strict_types=1);

namespace App\Controllers;

class MainController extends BaseController
{

    public function proxecto()
    {

        $data = [
            'titulo'     => 'Titulo',
        ];

        return view('templates/headerTemplate', $data)
            . view('proxecto');
        /* . view('templates/footerTemplate'); */
    }

    public function registro()
    {

        $data = [
            'titulo'     => 'Registro',
        ];

        return view('templates/headerTemplate', $data)
        . view('Shield/registro');
    }

    public function iniciar_sesion()
    {

        $data = [
            'titulo'     => 'Iniciar sesión',
        ];

        return view('templates/headerTemplate', $data)
        . view('Shield/iniciar_sesion');
    }

    public function perfil()
    {

        $data = [
            'titulo'     => 'Perfil de usuario',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/perfil');
    }

    public function subcategoria()
    {

        $data = [
            'titulo'     => 'Vista subcategoria',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/subcategoria');
    }
    public function tema()
    {

        $data = [
            'titulo'     => 'Vista tema',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/tema');
    }

    public function inicio()
    {

        $data = [
            'titulo'     => 'Vista general de inicio',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/inicio');
    }

    public function admin()
    {

        $data = [
            'titulo'     => 'Vista general del administrador',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/admin');
    }
}
