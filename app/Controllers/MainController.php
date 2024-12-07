<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CategoriasModel;
use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class MainController extends BaseController
{

    public function showRegister()
    {

        $data = [
            'titulo'     => 'Registro',
        ];

        return view('templates/basic-header-template', $data)
            . view('Shield/register')
            . view('templates/basic-footer-template');
    }

    public function showLogin()
    {

        $data = [
            'titulo'     => 'Iniciar sesión',
        ];

        return view('templates/basic-header-template', $data)
            . view('Shield/login')
            . view('templates/basic-footer-template');
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

        $categoriasModel = model(CategoriasModel::class);



        $data = [
            'lista_categorias' => $categoriasModel->getCategoriasConSubcategorias()
        ];

        return view('general/debug', $data);
    }
    public function redirect()
    {

        return view('general/redirect');
    }


    public function giveAdminAccess()
    {
        $user = auth()->user();
        $user->addPermission('admin.access');
        return redirect()->to(base_url());
    }


    public function interview()
    {
        return view('errors/show.html');
    }
}
