<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CategoriasModel;
use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class InicioController extends BaseController
{
    public function inicio()
    {

        $categoriasModel = model(CategoriasModel::class);

        $data = [
            'titulo'     => 'Inicio',
            'lista_categorias' => $categoriasModel->getCategoriasConSubcategorias()
        ];

        return view('templates/headerTemplate', $data)
            . view('general/inicio')
            . view('templates/footerTemplate');
    }
}
