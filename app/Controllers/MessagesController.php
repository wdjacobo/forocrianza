<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use \CodeIgniter\HTTP\RedirectResponse;

class MessagesController extends BaseController
{

    public function create()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('warn', 'Debes iniciar sesión para publicar un mensaje');
        }

        $messagesModel = model('MessagesModel');

        if ($this->request->is('post')) {

            return "Creación de mensaje";
            //Falta obtener el topic_id()!
            //
            $data = $this->request->getPost();

            $rules = [
                'content' => 'required|min_length[10]|trim',
            ];

            $errors = [
                'content' => [
                    'required' => 'Debes escribir algo en tu mensaje',
                    'min_length' => 'El mensaje es demasiado corto',
                ],
            ];

            //1. Validar
            if ($this->validateData($data, $rules, $errors)) {

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
                // Debería usar with()???? Y cambiar por redirect!!!=???
                $data['data'] = $data;
                $data['errors'] = $this->validator->getErrors();
                $data = [
                    'title'     =>  'Crear tema', //$topicsModel->getTitle($slug),
                    //['s'], //$topicsModel->getTopicMessages($slug),
                    'trending_subcategories' => $this->trendingSubcategories,
                    'trending_subcategories' => $this->trendingSubcategories,
                    'last_topics' => $this->lastTopics,
                    'topics_with_most_messages' => $this->topicsWithMostMessages,
                    'ad_urls' => $this->adUrls,
                ];
                $data['categoriesWithSubcategories'] = $categoriesModel->getCategoriesWithSubcategories();
                return view('templates/headerTemplate', $data)
                    . view('templates/asideTemplate')
                    . view('templates/asideModalTemplate')
                    . view('topics/create')
                    . view('templates/adBannerTemplate')
                    . view('templates/footerTemplate');
            }
        }
    }
}
