<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class CategoriesController extends BaseController
{
    /**
     * 
     * Muestra la página de categorías (listado de categorías ordenadas por título) del panel de administración si el usuario autenticado pertenece al grupo 'admin'.
     * 
     * Si el usuario no está autenticado o no pertenece al grupo 'admin' se lanza una excepción de página no encontrada.
     * 
     * 
     * @return string Renderización de la vista correspondiente.
     * 
     * @throws PageNotFoundException Si el usuario no está autenticado o no pertenece al grupo 'admin'.
     */
    public function index(): string
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        $categoriesModel = model('CategoriesModel');
        $data = [
            'title' => 'Categorías',
            'categories' => $categoriesModel->orderBy('title')->findAll(),
        ];

        return view('templates/adminHeaderTemplate', $data)
            . view('templates/adminAsideTemplate')
            . view('categories/index')
            . view('templates/adminFooterTemplate');
    }

    /**
     * Muestra la vista del formulario de creación de categoría o procesa la creación de una categoría.
     * 
     * Si el usuario no está autenticado o no pertenece al grupo 'admin' se lanza una excepción de página no encontrada.
     * 
     * Si la solicitud es GET, muestra el formulario, y si es POST procesa los datos, creando una nueva categoría y redirigiendo a la página de categorías o redirigiendo nuevamente al formulario junto con los errores encontrados en caso de haberlos.
     * 
     * @return string|RedirectResponse Renderización de la vista correspondiente para las solicitudes GET o redirección para las solicitudes POST.
     * 
     * @throws PageNotFoundException Si el usuario no está autenticado o no pertenece al grupo 'admin'.
     */
    public function create(): string|RedirectResponse
    {

        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "admin", ¿se habrá ido a por tabaco?');
        }

        if ($this->request->is('get')) {
            $data = [
                'title' => 'Crear categoría'
            ];

            return view('templates/adminHeaderTemplate', $data)
                . view('templates/adminAsideTemplate')
                . view('categories/create')
                . view('templates/adminFooterTemplate');
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

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos

                // 4. Acción en la BD
                $categoriesModel = model('CategoriesModel');
                $categoryTitle = $validData['category-title'];

                try {
                    $categoriesModel->insert(
                        [
                            'title' => $categoryTitle
                        ]
                    );

                    return redirect()->to('admin/categorias')->with('success', 'Categoría "' . $categoryTitle . '" creada correctamente.');
                } catch (\Exception $e) {

                    // 5. Manejo de excepciones
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al crear la categoría "' . $categoryTitle . '" y no se pudo realizar la acción, inténtalo de nuevo.');
                }
            } else {
                // 2. Devolver errores
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }

    /**
     * Elimina una categoría específica en base a su ID.
     * 
     * Redirige a la página de categorías junto con un mensaje de éxito o de error si se producen errores durante la acción.
     * 
     * @param int $category_id ID de la categoría a eliminar.
     * 
     * @return RedirectResponse Redirección a la página de categorías.
     */
    public function delete(int $category_id): RedirectResponse
    {
        $categoriesModel = model('CategoriesModel');
        $category = $categoriesModel->find($category_id);

        // 1. Acción en la BD
        try {

            $categoriesModel->delete($category_id);

            return redirect()->to('admin/categorias')->with('success', 'Categoría "' . $category['title'] . '" eliminada correctamente.');
        } catch (\Exception $e) {

            // 2. Manejo de excepciones
            return redirect()->back()->with('error', 'Se produjo un error al eliminar la categoría "' . $category['title'] . '" y no se pudo realizar la acción, inténtalo de nuevo.');
        }
    }

    /**
     * Muestra la vista del formulario de edición de categoría o procesa la edición de una categoría en base a su ID.
     * 
     * Si el usuario no está autenticado o no pertenece al grupo 'admin', o si la ID de la categoría no existe se lanza una excepción de página no encontrada.
     * 
     * Si la solicitud es GET, muestra el formulario, y si es PATCH procesa los datos, editando la  categoría y redirigiendo a la página de categorías o redirigiendo nuevamente al formulario junto con los errores encontrados en caso de haberlos.
     * 
     * @param int $category_id ID de la categoría a editar.
     * 
     * @return string|RedirectResponse Renderización de la vista correspondiente para las solicitudes GET o redirección para las solicitudes PATCH.
     * 
     * @throws PageNotFoundException Si el usuario no está autenticado o no pertenece al grupo 'admin', o si la categoría no existe.
     */
    public function patch(int $category_id): string|RedirectResponse
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
        }

        $categoriesModel = model('CategoriesModel');
        $category = $categoriesModel->find($category_id);

        if (!$category) {
            throw new PageNotFoundException('Parece que intentas editar una categoría que no existe.');
        }



        if ($this->request->is('get')) {

            $data = [
                'title' => 'Editando categoría ' . $category['title'],
                'category' => $category,
            ];

            return view('templates/adminHeaderTemplate', $data)
                . view('templates/adminAsideTemplate')
                . view('categories/patch')
                . view('templates/adminFooterTemplate');
        }

        if ($this->request->is('patch')) {

            $data = $this->request->getRawInput();
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

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos

                // 4. Acción en la BD
                $categoryTitleUpdated = $validData['category-title'];
                $category = $categoriesModel->find($category_id);

                try {

                    $categoriesModel->update(
                        $category_id,
                        [
                            'title' => $categoryTitleUpdated
                        ]
                    );

                    return redirect()->to('admin/categorias')->with('success', 'Categoría "' . $categoryTitleUpdated . '" editada correctamente.');
                } catch (\Exception $e) {
                    // 5. Manejo de excepciones
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al editar la categoría "' . $category['title'] . '" y no se pudo realizar la acción, inténtalo de nuevo.');
                }
            } else {
                // 2. Devolver errores 
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }
}
