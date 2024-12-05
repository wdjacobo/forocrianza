<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class TopicsController extends BaseController
{

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

            // Mostrar el contenido de los datos recibidos
            echo '<pre>';
            print_r($data); // Esto te mostrará todos los datos en el formato de array
            echo '</pre>';

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



    // Repasar estas funciones para create
    protected function generateSlug(string $title): string
    {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug); // Reemplaza espacios y caracteres especiales por "-"
        return trim($slug, '-');
    }

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
