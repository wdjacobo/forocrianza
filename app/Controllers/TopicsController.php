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



        //return $this->request->getMethod();
        //return "Hola";
        if ($this->request->getMethod() === HTTP_GET) {
            // Mostrar el formulario
            return view('/topics/create');
        }

        if ($this->request->getMethod() === HTTP_POST) {

            // Obtener todos los datos enviados por POST en un array asociativo
            $data = $this->request->getPost();

            //Una vez validados los datos...
            $title = $this->request->getPost('topic-title');
            //echo mb_url_title($title, '-', true);

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

            //TRansaction
            /*             $this->db->transStart();
$this->db->query('AN SQL QUERY...');
$this->db->query('ANOTHER QUERY...');
$this->db->query('AND YET ANOTHER QUERY...');
$this->db->transComplete(); */


            /*     $data = $this->request->getPost();
    
    // Inserta el registro inicial
    $model = model('TopicsModel');
    $id = $model->insert($data);

    // Genera el slug único
    $slug = url_title($data['title'], '-', true) . '-' . $id;

    // Actualiza el registro con el slug
    $model->update($id, ['slug' => $slug]);

    return redirect()->to('/temas/' . $slug);
 */

            /* Versión mejor, con uso de un placeholder
            $data['slug'] = url_title($data['title'], '-', true); // Slug inicial
            $id = $model->insert($data); // Insertar con un slug provisional
            
            // Generar el slug final y actualizar
            $slug = $data['slug'] . '-' . $id;
            $model->update($id, ['slug' => $slug]);
// Proceder con el slug
*/



















            return view('/topics/create');
            // Lógica para guardar el tema
            //return redirect()->to('/subcategoria-del-tema/');
        }


        // Acceder a los datos del formulario usando $this->request->getPost()
        $category = $this->request->getPost('category');
        $subcategory = $this->request->getPost('subcategory');
        $topicTitle = $this->request->getPost('topic-title');
        $topicOpeningMessage = $this->request->getPost('topic-opening-message');

        // Validar los datos si es necesario (opcional)
        if (!$category || !$subcategory || !$topicTitle || !$topicOpeningMessage) {
            // Manejar el error si algún campo es obligatorio y no se completó
            return redirect()->back()->withInput()->with('error', 'Por favor, completa todos los campos.');
        }

        // Ahora puedes hacer algo con estos datos, por ejemplo, guardarlos en la base de datos
        // $model = new TopicModel();
        // $model->save([
        //     'category' => $category,
        //     'subcategory' => $subcategory,
        //     'title' => $topicTitle,
        //     'message' => $topicOpeningMessage
        // ]);

        // O simplemente los muestras para ver qué datos recibiste:
        echo "Categoría: " . $category . "<br>";
        echo "Subcategoría: " . $subcategory . "<br>";
        echo "Título: " . $topicTitle . "<br>";
        echo "Contenido: " . $topicOpeningMessage . "<br>";

        // Redirigir a otra vista después de procesar
        return redirect()->to('/some-other-page');
    }

    /*Validación de creación de temas */

    /* $validation->setRules([
    'username' => [
        'label' => 'Nombre de usuario',
        'rules' => 'required|max_length[10]',
        'errors' => [
            'max_length' => 'El nombre de usuario no puede superar los 10 caracteres.',
        ],
    ],
]); */






















    public function showTopic(string $subcategorySlug, string $topicSlug)
    {
        // Extraer el ID del tema del slug
        $slugParts = explode('-', $topicSlug);
        $topicId = array_pop($slugParts); // El ID está al final del slug

        // Buscar el tema por ID
        $topicModel = model('TopicsModel');
        $topic = $topicModel->find($topicId);

        if (!$topic || $topic['subcategory_slug'] !== $subcategorySlug) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tema no encontrado.");
        }

        // Retornar la vista con el tema
        return view('topics/show', ['topic' => $topic]);
    }
}
