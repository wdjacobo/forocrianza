<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\SubcategoriesModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class SubcategoriesController extends BaseController
{

    /**
     * 
     * Muestra la página de subcategorías (listado de subccategorías ordenadas por título) del panel de administración si el usuario autenticado pertenece al grupo 'admin'.
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

        $subcategoriesModel = model('SubcategoriesModel');
        $data = [
            'title' => 'Subcategorías',
            'subcategories' => $subcategoriesModel->orderBy('title')->findAll(),
        ];

        return view('templates/adminHeaderTemplate', $data)
            . view('templates/adminAsideTemplate')
            . view('subcategories/index')
            . view('templates/adminFooterTemplate');
    }

    /**
     * Muestra la vista del formulario de creación de subcategoría o procesa la creación de una subcategoría.
     * 
     * Si el usuario no está autenticado o no pertenece al grupo 'admin' se lanza una excepción de página no encontrada.
     * 
     * Si la solicitud es GET, muestra el formulario, y si es POST procesa los datos, creando una nueva subccategoría y redirigiendo a la página de subcategorías o redirigiendo nuevamente al formulario junto con los errores encontrados en caso de haberlos.
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

            $categoriesModel = model('CategoriesModel');
            $categories = $categoriesModel->findAll();

            $data = [
                'title' => 'Crear subcategoría',
                'categories' => $categories,
            ];

            return view('templates/adminHeaderTemplate', $data)
                . view('templates/adminAsideTemplate')
                . view('subcategories/create')
                . view('templates/adminFooterTemplate');
        }

        if ($this->request->is('post')) {

            $data = $this->request->getPost();
            $categoriesModel = model('CategoriesModel');
            $categoriesIds = $categoriesModel->findColumn('id');
            $rules = [
                'category' => 'required|in_list[' . implode(',', $categoriesIds) . ']',
                'subcategory-title' => 'required|max_length[100]|trim|is_unique[subcategories.title]',
                'subcategory-description' => 'required|max_length[255]|trim',
            ];
            $errors = [
                'category' => [
                    'required' => 'Debes seleccionar una categoría.',
                    'in_list' => 'Debes seleccionar una categoría válida.',
                ],
                'subcategory-title' => [
                    'required' => 'Debes introducir un título.',
                    'max_length' => 'El título es demasiado largo.',
                    'is_unique' => 'El título ya está un uso por una subcategoría existente.',
                ],
                'subcategory-description' => [
                    'required' => 'Debes introducir una descripción.',
                    'max_length' => 'La descripción es demasiado larga.',
                ],
            ];

            //1. Validar
            if ($this->validateData($data, $rules, $errors)) {

                $validData = $this->validator->getValidated();

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos

                // 4. Acción en la BD
                $subcategoriesModel = model('SubcategoriesModel');
                $subcategoryTitle = $validData['subcategory-title'];

                try {

                    $subcategoriesModel->insert(
                        [
                            'title' => $subcategoryTitle,
                            'description' => $validData['subcategory-description'],
                            'slug' => mb_url_title($subcategoryTitle, '-', true),
                            'category_id' => $validData['category'],
                        ]
                    );

                    return redirect()->to('admin/subcategorias')->with('success', 'Subcategoría "' . $subcategoryTitle . '" creada correctamente.');
                } catch (\Exception $e) {

                    // 5. Manejo de excepciones
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al crear la subcategoría "' . $subcategoryTitle . '" y no se pudo realizar la acción, inténtalo de nuevo.');
                }
            } else {

                // 2. Devolver errores
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }

    /**
     * Elimina una subcategoría específica en base a su ID.
     * 
     * Redirige a la página de subccategorías junto con un mensaje de éxito o de error si se producen errores durante la acción.
     * 
     * @param int $subcategory_id ID de la subcategoría a eliminar.
     * 
     * @return RedirectResponse Redirección a la página de subcategorías.
     */
    public function delete(int $subcategory_id): RedirectResponse
    {
        $subcategoriesModel = model('SubcategoriesModel');
        $subcategory = $subcategoriesModel->find($subcategory_id);

        // 1. Acción en la BD
        try {

            $subcategoriesModel->delete($subcategory_id);

            return redirect()->to('admin/subcategorias')->with('success', 'Subcategoría "' . $subcategory['title'] . '" eliminada correctamente.');
        } catch (\Exception $e) {

            // 2. Manejo de excepciones
            return redirect()->back()->with('error', 'Se produjo un error al eliminar la subccategoría "' . $subcategory['title'] . '" y no se pudo realizar la acción, inténtalo de nuevo.');
        }
    }

    /**
     * Muestra la vista del formulario de edición de subcategoría o procesa la edición de una subcategoría en base a su ID.
     * 
     * Si el usuario no está autenticado o no pertenece al grupo 'admin', o si la ID de la subcategoría no existe se lanza una excepción de página no encontrada.
     * 
     * Si la solicitud es GET, muestra el formulario, y si es PATCH procesa los datos, editando la  subcategoría y redirigiendo a la página de subcategorías o redirigiendo nuevamente al formulario junto con los errores encontrados en caso de haberlos.
     * 
     * @param int $subcategory_id ID de la subcategoría a editar.
     * 
     * @return string|RedirectResponse Renderización de la vista correspondiente para las solicitudes GET o redirección para las solicitudes PATCH.
     * 
     * @throws PageNotFoundException Si el usuario no está autenticado o no pertenece al grupo 'admin', o si la subcategoría no existe.
     * 
     *
     */
    public function patch(int $subcategory_id): string|RedirectResponse
    {
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
        }

        $subcategoriesModel = model('SubcategoriesModel');
        $subcategory = $subcategoriesModel->find($subcategory_id);

        if (!$subcategory) {
            throw new PageNotFoundException('Parece que intentas editar una subcategoría que no existe.');
        }

        $categoriesModel = model('CategoriesModel');
        $categories = $categoriesModel->findAll();

        if ($this->request->is('get')) {

            $data = [
                'title' => 'Editando subcategoría ' . $subcategory['title'],
                'subcategory' => $subcategory,
                'categories' => $categories,
            ];

            return view('templates/adminHeaderTemplate', $data)
                . view('templates/adminAsideTemplate')
                . view('subcategories/patch')
                . view('templates/adminFooterTemplate');
        }

        if ($this->request->is('patch')) {

            $data = $this->request->getRawInput();
            $categoriesModel = model('CategoriesModel');
            $categoriesIds = $categoriesModel->findColumn('id');
            $rules = [
                'category' => 'required|in_list[' . implode(',', $categoriesIds) . ']',
                'subcategory-title' => 'required|max_length[100]|trim|is_unique[subcategories.title,id, ' . $subcategory_id . ']', // Añadimos la excepción de su propio título
                'subcategory-description' => 'required|max_length[255]|trim',
            ];
            $errors = [
                'category' => [
                    'required' => 'Debes seleccionar una categoría.',
                    'in_list' => 'Debes seleccionar una categoría válida.',
                ],
                'subcategory-title' => [
                    'required' => 'Debes introducir un título.',
                    'max_length' => 'El título es demasiado largo.',
                    'is_unique' => 'El título ya está un uso por una subcategoría existente.',
                ],
                'subcategory-description' => [
                    'required' => 'Debes introducir una descripción.',
                    'max_length' => 'La descripción es demasiado larga.',
                ],
            ];

            //1. Validar
            if ($this->validateData($data, $rules, $errors)) {

                $validData = $this->validator->getValidated();

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos

                // 4. Acción en la BD
                $subcategoryTitleUpdated = $validData['subcategory-title'];
                $subcategory = $subcategoriesModel->find($subcategory_id);

                try {

                    $subcategoriesModel->update(
                        $subcategory_id,
                        [
                            'title' => $subcategoryTitleUpdated,
                            'description' => $validData['subcategory-description'],
                            'slug' => mb_url_title($subcategoryTitleUpdated, '-', true),
                            'category_id' => $validData['category'],
                        ]
                    );

                    return redirect()->to('admin/subcategorias')->with('success', 'Subcategoría "' . $subcategoryTitleUpdated . '" editada correctamente.');
                } catch (\Exception $e) {

                    // 5. Manejo de excepciones
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al editar la subcategoría "' . $subcategory['title'] . '" y no se pudo realizar la acción, inténtalo de nuevo.');
                }
            } else {

                // 2. Devolver errores 
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }













    public function show($slug)
    {
        $subcategoriesModel = model('SubcategoriesModel');

        if ($subcategoriesModel->getSubcategoryBySlug($slug) === []) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "' . $slug . '", ¿se habrá ido a por tabaco?');
        }

        $subcategory = $subcategoriesModel->where('slug', $slug)->first();
        //return var_dump($subcategoriesModel->getSubcategoryTopics($subcategory['id']));

        $data = [
            'title'     => $subcategory['title'],
            'slug' => $subcategory['slug'],
            'subcategory_topics' => [],
            'trending_subcategories' => $this->trendingSubcategories,
            'last_topics' => $this->lastTopics,
            'topics_with_most_messages' => $this->topicsWithMostMessages,
            'ad_urls' => $this->adUrls,
        ];


        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('templates/asideModalTemplate')
            . view('subcategories/show')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }
}
