<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\UsuariosModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UsuariosController extends BaseController
{
/*     public function index(): string
    {
        return view('welcome_message');
    } */

    public function index()
    {
        $model = model(UsuariosModel::class);


        $data = [
            'lista_usuarios' => $model->getUsuario(),
            'titulo'     => 'Listado de usuarios',
        ];

        return view('templates/headerTemplate', $data)
            . view('usuarios/index')
            . view('templates/footerTemplate');
    }

    public function mostrar(?string $id = null)
    {
        $model = model(UsuariosModel::class);

        $data['usuario'] = $model->getUsuario($id);

        if ($data['usuario'] === null) {
            throw new PageNotFoundException('Cannot find the news item: ' . $id);
        }

        $data['titulo'] = $data['usuario']['nickname'];

        return view('templates/headerTemplate', $data)
            . view('usuarios/view')
            . view('templates/footerTemplate');
    }
}
