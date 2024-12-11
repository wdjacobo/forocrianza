<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class SubcategoriesController extends BaseController
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
     * Muestra la vista del formulario de creación de categoría o procesa la creación de una categoría.
     * 
     * Si el usuario no está autenticado o no pertenece al grupo 'admin' se lanza una excepción de página no encontrada.
     * 
     * Si la solicitud es GET, muestra el formulario, y si es POST procesa los datos, creando una nueva categoría y redirigiendo a la página de categorías o redirigiendo nuevamente al formulario junto con los errores encontrados en caso de haberlos.
     * 
     * @return string|RedirectResponse Renderización de la vista correspondiente para las solicitudes GET o redirección para las solicitudes POST.
     * 
     * @throws PageNotFoundException Si el usuario no está autenticado o no pertenece al grupo 'admin'.
     * : string|RedirectResponse
     */
    public function create()
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
                            'slug' => mb_url_title($validData['subcategory-title'], '-', true),
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
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function _create()
    {
        //Pulir, tener en cuenta en el login la redirect_url sería lo deseable
        if (!auth()->loggedIn()) {
            session()->set('redirect_url', current_url());
            //Flashdata a coger en login error para crear un tema debes tener una cuenta de usuario.
            return redirect()->to('index');
        }

        // Es necesario para el uso de set_value() en las vistas!
        helper('form');


        //Título, description y category_id

        $categoriesModel = model('CategoriesModel');
        $subcategoriesModel = model('SubcategoriesModel');
        $data['categories'] = $categoriesModel->getCategories();
        $data['categoriesWithSubcategories'] = $categoriesModel->getCategoriesWithSubcategories();

        $categoriesIds = $categoriesModel->findColumn('id');
        $subcategoriesIds = $subcategoriesModel->findColumn('id');


        if ($this->request->is('get')) {







            return view('templates/headerTemplate', $data)
                . view('templates/asideTemplate')
                . view('templates/asideModalTemplate')
                . view('topics/create')
                . view('templates/adBannerTemplate')
                . view('templates/footerTemplate');


            return view('/topics/create', $data);
        }

        if ($this->request->is('post')) {

            //Falta obtener el author_id!
            $data = $this->request->getPost();
            $data['categories'] = $categoriesModel->getCategories();
            $data['categoriesWithSubcategories'] = $categoriesModel->getCategoriesWithSubcategories();

            // Consultar reglas: https://codeigniter4.github.io/userguide/libraries/validation.html#rules-for-general-use
            $rules = [
                // La regla in_list espera una lista de valores separados por comas entre los corchetes
                'category' => 'required|in_list[' . implode(',', $categoriesIds) . ']',
                'subcategory' => 'required|in_list[' . implode(',', $subcategoriesIds) . ']',
                'topic-title' => 'required|min_length[10]|max_length[250]|trim',
                'topic-opening-message'    => 'required|min_length[40]|trim',
            ];

            $errors = [
                'category' => [
                    'required' => 'Debes seleccionar una categoría.',
                    'in_list' => 'Debes seleccionar una categoría válida.',
                ],
                'subcategory' => [
                    'required' => 'Debes seleccionar una subcategoría.',
                    'in_list' => 'Debes seleccionar una subcategoría válida.',
                ],
                'topic-title' => [
                    'required' => 'Debes introducir un título.',
                    'min_length' => 'El título debe tener al menos 10 caracteres.',
                    'max_length' => 'El título no puede tener más de 250 caracteres.',
                ],
                'topic-opening-message' => [
                    'required' => 'Debes introducir contenido.',
                    'min_length' => 'El contenido debe tener al menos 40 caracteres.',
                ],
            ];

            //1. Validar
            if ($this->validateData($data, $rules, $errors)) {

                //ENGADIR TRY CATCH??

                $validData = $this->validator->getValidated();
                $validData['author-id'] = user_id();

                // 3. Sanitizar
                //No se aplica sanitización concreta ya que el query builder escapa los datos
                // Aplicar sanitización de Quill usando clean_html de HTML Purifier; strip_tags() no es seguro, no sanitiza los atributos.

                // 4. Acción en la BD

                $topicsModel = model('TopicsModel');
                $transactionStatus = $topicsModel->create($validData);

                if ($transactionStatus) {
                    $topicId = $topicsModel->getInsertID();
                    $topicSlug = $topicsModel->find($topicId)['slug'];
                    $subcategorySlug = $subcategoriesModel->find($topicsModel->find($topicId)['subcategory_id'])['slug'];
                    $ruta = base_url("$subcategorySlug/$topicSlug");
                    /*                     echo "Todo salió bien, id del tema insertado: $topicId<br>Slug del tema: $topicSlug<br>Slug de la subcategoría del tema: $subcategorySlug<br>Ruta hacia el tema: $ruta";
                        exit(); */

                    // 5. Redirigir al tema recién creado
                    return redirect()->to(base_url("$subcategorySlug/$topicSlug"));
                } else {
                    return redirect()->back()->withInput()->with('error', 'Se produjo un error al guardar el tema');
                }



                try {
                    $transactionStatus = $topicsmodel->create($validData);
                    if ($transactionStatus) {
                        $id = $topicsModel->getInsertID();
                        $newTopicSlug = $topicsModel->find($id)['slug'];
                        //Conseguir el slug de la subcategoría...
                        echo "Todo salió bien, id del tema insertado: $id<br>Slug del tema: $newTopicSlug";
                        exit();
                    } else {
                        echo "Algo salió mal";
                        exit();
                    }

                    // Redirigir si todo sale bien             //redirigir al usuario a la página del tema recién creado
                    //return redirect()->to('/success-page');
                } catch (\Exception $e) { // Usamos \ para el namespace global de PHP
                    //Retornar la página con error de esto en concreto:
                    /*                     $data['data'] = $data;
                        $data['errors'] = $this->validator->getErrors();
                        return view('/topics/create', $data); */

                    echo "Se ha producido un error: " . $e->getMessage();
                    exit();
                    // Si hay un error, mostrarlo y hacer un rollback si fuera necesario
                    return redirect()->back()->with('error', $e->getMessage());
                }
            } else { // 2. Devolver errores
                // Debería usar with()????
                $data['data'] = $data;
                $data['errors'] = $this->validator->getErrors();
                return view('/topics/create', $data);
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




//USAR IS UNIQUE CON EXCEPCION: is_unique[subcategories.title,id,{id}]'
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













    /**
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function show($slug)
    {
        $subcategoriesModel = model('SubcategoriesModel');

        if ($subcategoriesModel->getSubcategoryBySlug($slug) === []) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "' . $slug . '", ¿se habrá ido a por tabaco?');
        }



        $data = [
            'title'     => $subcategoriesModel->getTitle($slug),
            'slug' => $slug,
            'subcategory_topics' => $subcategoriesModel->getSubcategoryTopics($slug),
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
            . view('templates/asideModalTemplate')
            . view('templates/footerTemplate');
    }
}
