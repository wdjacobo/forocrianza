<?php

declare(strict_types=1);

namespace App\Controllers;

class AdminController extends BaseController
{


        //Ver este redirect para admin
        public function debug()
        {
    
            //$categoriasModel = model(CategoriasModel::class);
    
    
    
            $data = [
                //'lista_categorias' => $categoriasModel->getCategoriasConSubcategorias()
            ];
    
            return view('general/debug', $data);
        }
        public function redirect()
        {
    
            return view('general/redirect');
        }


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
