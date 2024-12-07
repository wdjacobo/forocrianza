<?php

declare(strict_types=1);

namespace App\Controllers;

class CategoriesController extends BaseController
{
    public function create()
    {
        // No se permite el acceso a usuarios no autenticados y no autorizados
        if (!auth()->loggedIn() || !auth()->user()->can('admin.access')) {
            session()->set('redirect_url', current_url());
            //En este caso no queremos dar información de por qué se redirige
            return redirect()->to('/');
        }

        // Es necesario para el uso de set_value() en las vistas!
        helper('form');


        if ($this->request->is('get')) {
            $data = [
                'title' => 'Panel de administración'
            ];


            return view('admin/show', $data);
        }

        if ($this->request->is('post')) {

            $data = $this->request->getPost();

            $rules = [
                'category-title' => 'required|max_length[100]|trim'
            ];

            $errors = [
                'category-title' => [
                    'required' => 'Debes seleccionar una categoría.',
                    'max_length' => 'Debes seleccionar una categoría válida.',
                ],
            ];

            //1. Validar
            if ($this->validateData($data, $rules, $errors)) {

                $validData = $this->validator->getValidated();

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos

                // 4. Acción en la BD
                $categoriesModel = model('CategoriesModel');

                try {
                    $categorie = $cat;
                    //echo "Éxito!"; exit();
                    $categoriesModel->insert(
                        [
                            'title' => $validData,
                        ]
                    );
                    return redirect()->to(base_url("/admin/categorias"));
                    return redirect()->to(base_url("/admin"));
                } catch (\Exception $e) {
                    //echo "Error!"; exit();
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al registrar la categoría');
                }
            } else { // 2. Devolver errores
                $data['data'] = $data;
                $data['errors'] = $this->validator->getErrors();

                //Cambiar por redirect();
                return view('admin/show', $data);
            }
        }
    }
}
