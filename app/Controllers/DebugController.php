<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CategoriasModel;
use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class DebugController extends BaseController
{

    public function debug()
    {

        $categoriasModel = model(CategoriasModel::class);
        


        $data = [
            'lista_categorias' => $categoriasModel->getCategoriasConSubcategorias(),
            'categoria_unica' => $categoriasModel->getCategoriasConSubcategorias(3)
        ];

        return view('general/debug', $data);
    }
}
