<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class TopicsController extends BaseController
{

    //Revisar para show.
    public function index()
    {
        $model = model('topicsModel');

        //Uso de paginate!
        $data = [
            'users' => $model->paginate(10),
            'pager' => $model->pager,
        ];

        // If you want to add WHERE conditions
        $data = [
            'users' => $model->where('ban', 1)->paginate(10),
            'pager' => $model->pager,
        ];

        // Ou pasar ao modelo isto:
        /*         public function banned()
        {
            $this->builder()->where('ban', 1);
    
            return $this; // This will allow the call chain to be used.
        } */
        // E aquí facer
        $data = [
            'users' => $model->banned()->paginate(10),
            'pager' => $model->pager,
        ];

        // En la vista usamos así los links:
        /*<?= $pager->links() ?> */


        return view('users/index', $data);
    }



    public function show($subcategory_slug, $topic_slug)
    {
        $topicsModel = model('TopicsModel');

        if ($topicsModel->getTopicBySlug($topic_slug) === []) {
            throw new PageNotFoundException('No se ha podido encontrar el tema "' . $topic_slug . '".');
        }

        $resultado = $topicsModel->getTopicMessagesBySlug($topic_slug);
        $titulo = $resultado[0]['topic_title'];

        $data = [
            'title'     => $titulo, //$topicsModel->getTitle($slug),
            'slug' => $topic_slug,
            'topic_messages' => $topicsModel->getTopicMessagesBySlug($topic_slug), //['s'], //$topicsModel->getTopicMessages($slug),
            'trending_subcategories' => $this->trendingSubcategories,
            'mostVisitedTopics' => $this->mostVisitedTopics,
            'mostVisitedTopics' => $this->lastTopics,
            'mostVisitedTopics' => $this->mostVisitedTopics,
            'mostVisitedTopics' => $this->todayTopic,
            'ad_urls' => $this->adUrls,
        ];

        /*         return view('templates/headerTemplate', $data)
            . view('general/topic')
            . view('templates/footerTemplate'); */

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('topics/show')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }




    public function create()
    {

        // Necesario si usamos el form helper, aunque podríamos cargarlo en la clase con protected $helpers = ['form'];
        // Es necesario para el uso de set_value()!
        helper('form');

        $categoriesModel = model('CategoriesModel');
        $subcategoriesModel = model('SubcategoriesModel');
        $data['categories'] = $categoriesModel->getCategories();
        $data['subcategories'] = $subcategoriesModel->getSubcategories();
        // $categorieswith = $categoriesModel->getCategoriesWithSubcategories();
        //var_dump($categorieswith);






        if ($this->request->is('get')) {
            return view('/topics/create', $data);
        }

        if ($this->request->is('post')) {

            $data = $this->request->getPost();

            // Consultar reglas: https://codeigniter4.github.io/userguide/libraries/validation.html#rules-for-general-use
            $rules = [
                // Faltaría añadir que esté su id en la BD como usar in_list así?
                'category' => 'required|in_list[5,6]',
                'subcategory' => 'required|in_list[1,2,3]',
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
                echo "Datos validados!";

                $validData = $this->validator->getValidated();

                var_dump($validData);
                exit();

                // 3. Sanitizar
                //Usar esc()


                // 4. Acción en la BD

                // Ver abajo en create_()


                // 5. Redirigir al tema recién creado



            } else { // 2. Devolver errores
                $data['data'] = $data;
                $data['errors'] = $this->validator->getErrors();
                return view('/topics/create', $data);
            }
        }
    }











    public function create_()
    {

        // $model = new TopicModel();
        // $model->save([
        //     'category' => $category,
        //     'subcategory' => $subcategory,
        //     'title' => $topicTitle,
        //     'message' => $topicOpeningMessage
        // ]);

        try {
            //Guardar tema con placeholder en el slug
            //Update al tema con slug correcto esta vez
            //redirigir al usuario a la página del tema recién creado

        } catch (\Exception $e) { // Usamos \ para el namespace global de PHP

        }

        try {
            // Iniciar una transacción para asegurar atomicidad
            $db = \Config\Database::connect();
            $db->transStart();

            // Guardar tema con placeholder en el slug
            $placeholderSlug = 'placeholder-slug';
            $temaData = [
                'title' => $title,
                'content' => $content,
                'subcategory_id' => $subcategory_id,
                'slug' => $placeholderSlug, // Placeholder inicial
            ];
            $temaId = $temaModel->insert($temaData); // Obtener el ID recién creado

            if (!$temaId) {
                throw new \Exception("No se pudo guardar el tema");
            }

            // Generar slug correcto basado en el título y el ID
            $slug = url_title($title, '-', true) . '-' . $temaId;

            // Actualizar el tema con el slug correcto
            $updateResult = $temaModel->update($temaId, ['slug' => $slug]);
            if (!$updateResult) {
                throw new \Exception("No se pudo actualizar el slug del tema");
            }

            // Confirmar transacción
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception("Hubo un error en la transacción");
            }

            // Redirigir al usuario a la página del tema creado
            return redirect()->to('/foro/' . $slug);
        } catch (\Exception $e) {
            // En caso de error, revertir transacción
            $db->transRollback();

            // Manejar el error (log, mensaje al usuario, etc.)
            log_message('error', $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al crear el tema, por favor intente nuevamente.');
        }
    }
    //TRansaction : https://www.codeigniter.com/user_guide/database/transactions.html
    /*             $this->db->transStart();
$this->db->query('AN SQL QUERY...');
$this->db->query('ANOTHER QUERY...');
$this->db->query('AND YET ANOTHER QUERY...');
$this->db->transComplete(); */
    /*
    
    // Inserta el registro inicial
    $model = model('TopicsModel');
    $id = $model->insert($data);

    // Genera el slug único
    $slug = url_title($data['title'], '-', true) . '-' . $id;

    // Actualiza el registro con el slug
    $model->update($id, ['slug' => $slug]);

    return redirect()->to('/temas/' . $slug);

    Versión mejor, con uso de un placeholder
            $data['slug'] = url_title($data['title'], '-', true); // Slug inicial
            $id = $model->insert($data); // Insertar con un slug provisional
            
            // Generar el slug final y actualizar
            $slug = $data['slug'] . '-' . $id;
            $model->update($id, ['slug' => $slug]);
// Proceder con el slug
*/
}
