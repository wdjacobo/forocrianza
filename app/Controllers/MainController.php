<?php
declare(strict_types=1);

namespace App\Controllers;

class MainController extends BaseController
{

    public function index()
    {

        $data = [
            'titulo'     => 'Titulo',
        ];

        return view('templates/headerTemplate', $data)
            . view('inicioView')
            . view('templates/footerTemplate');
    }
}
