<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CategoriasModel;
use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class AdminController extends BaseController
{

    public function show()
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
}
