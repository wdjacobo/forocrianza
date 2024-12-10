<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class CategoriesController extends BaseController
{

    public function createForm($category_id)
    {

        return "vas a editar esto?";
        $categoryModel = model('CategoryModel');

        try {
            //$e=$a;
            $categoryModel->delete($category_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Se produjo un error al eliminar la categoría y no se pudo realizar la acción.');
        }

        redirect()->to('admin-categories');
    }










    /**
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
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
                    //$categorie = $cat;
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




    public function delete($category_id)
    {
        $categoriesModel = model('CategoriesModel');
        try {
            $categoriesModel->delete($category_id);
            return redirect()->to('admin/categorias');
        } catch (\Exception $e) {
            return redirect()->to('admin/categorias')->with('error', 'Se produjo un error al eliminar la categoría y no se pudo realizar la acción.');
        }
    }


    public function patch($category_id)
    {

        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
        }


        $categoriesModel = model('CategoriesModel');

        $data = [
            'title' => 'Temas',
            'category' => $categoriesModel->find($category_id),
        ];

        if ($this->request->is('get')) {

            $category = $categoriesModel->find($category_id);
            return "vas al formulario de parchear " . $category['title'];

            return view('categories/patch', $data);

            return view('templates/headerTemplate', $data)
                . view('templates/asideTemplate')
                . view('templates/asideModalTemplate')
                . view('topics/create')
                . view('templates/adBannerTemplate')
                . view('templates/footerTemplate');


            return view('/topics/create', $data);
        }

        if ($this->request->is('patch')) {

            return "Ejecución del parcheo";
        }

        $categoryModel = model('CategoryModel');

        try {
            //$e=$a;
            $categoryModel->delete($category_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Se produjo un error al eliminar la categoría y no se pudo realizar la acción.');
        }

        redirect()->to('admin-categories');
    }
}
