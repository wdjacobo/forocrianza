<?php

declare(strict_types=1);

namespace App\Controllers;

class MainController extends BaseController
{

    public function registro()
    {

        $data = [
            'titulo'     => 'Registro',
        ];

        return view('templates/basic-header-template', $data)
        . view('Shield/registro')
        . view('templates/basic-footer-template');
    }

    public function iniciar_sesion()
    {

        $data = [
            'titulo'     => 'Iniciar sesión',
        ];

        return view('templates/basic-header-template', $data)
        . view('Shield/iniciar_sesion')
        . view('templates/basic-footer-template');
    }

    public function perfil()
    {

        $data = [
            'titulo'     => 'Perfil',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/perfil')
            . view('templates/footerTemplate');
    }

    public function subcategoria()
    {

        $data = [
            'titulo'     => 'Subcategoria',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/subcategoria')
            . view('templates/footerTemplate');
    }
    public function tema()
    {

        $data = [
            'titulo'     => 'Tema',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/tema')
            . view('templates/footerTemplate');
    }

    public function inicio()
    {

        $data = [
            'titulo'     => 'Inicio',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/inicio')
            . view('templates/footerTemplate');
    }

    public function admin()
    {

        $data = [
            'titulo'     => 'Panel de administración',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/admin')
            . view('templates/footerTemplate');
    }

    public function admin_dash()
    {

        $data = [
            'titulo'     => 'Panel de administración',
        ];

        return view('general/admin_dash');
    }

    public function blog()
    {

        $data = [
            'titulo'     => 'Blog',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/blog')
            . view('templates/footerTemplate');
    }
    public function blog_post()
    {

        $data = [
            'titulo'     => 'Entrada blog',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/blog-post')
            . view('templates/footerTemplate');
    }

    public function nuevo_tema()
    {

        $data = [
            'titulo'     => 'Nuevo tema',
        ];

        return view('templates/headerTemplate', $data)
            . view('general/nuevo-tema')
            . view('templates/footerTemplate');
    }

    public function quill()
    {

        $data = [
            'titulo'     => 'Nuevo tema',
        ];

        return view('general/quill');
    }

    public function debug()
    {

        return view('general/debug');
    }
    public function redirect()
    {

        return view('general/redirect');
    }
}
