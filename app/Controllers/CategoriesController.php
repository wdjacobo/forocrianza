<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class CategoriesController extends BaseController
{


    public function index()
    {


        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }
        // Es necesario para el uso de set_value() en las vistas!
        helper('form');


        $categoriesModel = model('CategoriesModel');

        $data = [
            'title' => 'Categorías',
            'categories' => $categoriesModel->orderBy('title')->findAll(),
        ];


        return view('categories/index', $data);
        /*         return view('templates/headerTemplate', $data)
        . view('general/nuevo-tema')
        . view('templates/footerTemplate'); */
        //return redirect()->to(base_url());
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
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        if ($this->request->is('get')) {
            $data = [
                'title' => 'Crear categoría'
            ];

            return view('categories/create', $data);
        }

        if ($this->request->is('post')) {

            $data = $this->request->getPost();

            $rules = [
                'category-title' => 'required|max_length[100]|trim'
            ];

            $errors = [
                'category-title' => [
                    'required' => 'Debes introducir un título.',
                    'max_length' => 'El título es demasiado largo.',
                ],
            ];

            //1. Validar
            if ($this->validateData($data, $rules, $errors)) {

                $validData = $this->validator->getValidated();
                $categoryTitle = $validData['category-title'];
                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos

                // 4. Acción en la BD
                $categoriesModel = model('CategoriesModel');

                try {
                    $categoriesModel->insert(
                        [
                            'title' => $categoryTitle
                        ]
                    );

                    return redirect()->to("/admin/categorias")->with('message', "Se ha creado la categoría $categoryTitle.");
                } catch (\Exception $e) {
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al crear la categoría y no se pudo realizar la acción. Inténtalo de nuevo.');
                }
            } else { // 2. Devolver errores
                return redirect()->to('admin/crear-categoria')->withInput()->with('errors', $this->validator->getErrors());
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
            return redirect()->to('admin/categorias')->with('error', 'Se produjo un error al eliminar la categoría y no se pudo realizar la acción. Inténtalo de nuevo.');
        }
    }


    public function patch($category_id)
    {

        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
        }


        $categoriesModel = model('CategoriesModel');

        $data = [
            'title' => 'Editar categoría',
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
