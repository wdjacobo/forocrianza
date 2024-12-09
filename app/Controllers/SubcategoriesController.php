<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class SubcategoriesController extends BaseController
{

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
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "' . $slug . '"¿Se habrá ido a por tabaco?');
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
            . view('subcategories/show')
            . view('templates/adBannerTemplate')
            . view('templates/asideModalTemplate')
            . view('templates/footerTemplate');
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
        //Pulir, tener en cuenta en el login la redirect_url sería lo deseable
        if (!auth()->loggedIn()) {
            session()->set('redirect_url', current_url());
            //Flashdata a coger en login error para crear un tema debes tener una cuenta de usuario.
            return redirect()->to('iniciar-sesion')->with('warn', 'Debes iniciar sesión para publicar un tema');
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
}
