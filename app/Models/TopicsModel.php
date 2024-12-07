<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;


class TopicsModel extends Model
{
    protected $table = 'topics';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    // Solo admin y mod pueden modificar el id_subcategoria una vez creada el tema
    protected $allowedFields = ['title', 'opening_message', 'slug', 'subcategory_id', 'author_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    // Cargar el modelo de mensajes en el constructor
    protected $messagesModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de mensajes
        $this->messagesModel = model('MessagessModel');
    }


    /**
     * 
     * With this code, you can perform two different queries.
     * You can get all news records, or get a news item by its slug.
     * You might have noticed that the $slug variable wasn’t escaped before running the query;
     * Query Builder does this for you.
     * 
     * @param false|string $titulo
     *
     * @return array|null
     */
    public function getTopicBySlug($topic_slug)

    {
        $resultArray = $this->select('topics.*')
            ->where('topics.slug', $topic_slug)
            ->get()
            ->getResultArray();



        return $resultArray;
    }

    public function create($data)

    {
        //Falta obtener el author_id
/*         echo "Datos validados pasados al modelo:<br><br>";
        var_dump($data);
        exit();
 */
        // Se inicia una transacción para asegurarnos de que todo sale correctamente con la generación del slug y el update
        $this->db->transStart();

        //Guardamos el tema con un placeholder en el slug
        // Insertamos el registro y almacenamos su ID
        $topicId = $this->insert(
            [
                'title' => $data['topic-title'],
                'opening_message' => $data['topic-opening-message'],
                'slug' => $data['topic-title'] . rand(0, 1000),
                'subcategory_id' => $data['subcategory'],
                'author_id' => $data['author-id'],
            ]
        );
        $topic = $this->find($topicId);

        /*         $topic = $this->find($topicId);
        echo "<br><br><br><br>Tema insertado:<br><br>";
        var_dump($topic); //exit(); */

        // Generamos slug a partir del título eliminando espacios y caracteres especiales, separado por guiones, en minúscula, junto con el ID del tema, garantizando unicidad
        $slug = mb_url_title($topic['title'], '-', true) . "-$topicId";

        // Actualizamos el tema con el slug correcto
        $this->update($topicId, ['slug' => $slug]);

        //$topic = $this->find($topicId);

        /*         echo "<br><br><br><br>Tema insertado con slug nueva:<br><br>";
        $topic = $this->find($topicId);
        var_dump($topic); exit(); */


        // Completa la transacción
        $this->db->transComplete();

        //Se realiza un rollback automático si falla.

        //retornar el transStatus mejor, indicando si hubo fallo o éxito.

        // Verifica si la transacción fue exitosa

        return $this->db->transStatus();
    }




    /**
     * 
     * With this code, you can perform two different queries.
     * You can get all news records, or get a news item by its slug.
     * You might have noticed that the $slug variable wasn’t escaped before running the query;
     * Query Builder does this for you.
     * 
     * @param false|string $titulo
     *
     * @return array|null
     */
    public function getTopics($topic_id = false)

    {
        if ($topic_id === false) {
            return $this->findAll();
        }
        return $this->find($topic_id);
    }


    /**
     * Obtiene categorías y sus subcategorías.
     * Puede realizar dos acciones:
     *  - Búsqueda por ID si se pasa como parámetro
     *  - Búsqueda de todas las categorías si no se pasa un ID como parámetro
     * 
     * @param int|null $category_id La ID de la categoría a obtener. Si es null, se obtendrán todas.
     * 
     * @return array|null Devuelve un array de categorías junto con sus subcategorías si se encuentran o null si no se encuentran.
     */
    public function getTopicMessagesBySlug($topic_slug): array
    {

        //Aquí faltaría tamén coller data de creación da mensaxe. E ordear por ela!
        /*         $resultArray = $this->select('messages.content, messages.author_id, messages.parent_message_id, users.username AS author')
            ->join('messages', 'topics.id = messages.topic_id', 'left')->orderBy('messages.id') // Aquí sería created_at
            ->join('users', 'messages.author_id = users.id')  // JOIN con users usando author_id
            ->where('topics.slug', $topic_slug)
            ->get()
            ->getResultArray(); */

        // ver ben diferencia entre usar inner ou left join

        // Aquí estou repetindo a mesma información en cada elemento do array, conviría ordealo como no caso de categories e subcategories
        $resultArray = $this->select('
 topics.opening_message AS topic_opening_message,
 topic_author.username AS topic_author_username,
 topics.title AS topic_title,
 topics.author_id AS topic_author_id,
 topic_author_info.status_message AS topic_author_status_message,
 messages.content AS message_content,
 messages.parent_message_id, 
 messages.created_at AS message_creation_date,
 messages.updated_at AS message_update_date,
 message_author.username AS message_author_username, 
 message_author_info.status_message AS message_author_status_message,
 messages.author_id AS message_author_id,
')
            ->join('users AS topic_author', 'topic_author.id = topics.author_id', 'left')  // Relación entre topics y el autor del topic
            ->join('users_info AS topic_author_info', 'topic_author_info.id = topic_author.id', 'left')             // Relación entre message_author y users_info
            ->join('messages', 'topics.id = messages.topic_id', 'left')                   // Relación entre topics y messages
            ->join('users AS message_author', 'message_author.id = messages.author_id', 'left') // Relación entre messages y el autor de cada mensaje
            ->join('users_info AS message_author_info', 'message_author_info.id = message_author.id', 'left')             // Relación entre message_author y users_info
            ->where('topics.slug', $topic_slug)                                           // Filtro por slug del topic
            ->orderBy('messages.created_at', 'ASC')                                       // Asegura el orden por fecha de creación
            ->get()
            ->getResultArray();

        //var_dump($resultArray); die();

        /*             $resultArray =  $this->select('topics.title, messages.content')
            ->where('topics.slug', $topic_slug)                         // Filtro por slug del topic
            ->get()
            ->getResultArray(); */

        //             ->orderBy('messages.created_at', 'ASC')                     // Orden por fecha de creación

        /*         var_dump($resultArray);
        exit(); */

        return $resultArray;
    }







    /**
     * Obtener subcategorías por id_categoria
     * 
     * @param int $id_categoria
     * @return array
     */
    public function getTopicsBySubcategory($subcategory_id)
    {
        return $this->where('subcategory_id', $subcategory_id)->findAll();
    }

    /**
     * Obtener todas las categorías con sus subcategorías
     * 
     * @return array
     */
    public function getTopicsWithMessages($topic_id = false)
    {
        if ($topic_id === false) {

            // Obtener todas las categorías
            $topics = $this->findAll();

            // Para cada categoría, obtener sus subcategorías
            foreach ($topics as &$topic) {
                // Obtener subcategorías asociadas a esta categoría
                $topic['messages'] = $this->messagesModel->getMessagesbyTopic($topic['id']);
            }


            return $topics;
        }


        $topic = $this->find($topic_id);
        $topic['messages'] = $this->messagessModel->getTopicsBySubcategoryId($topic_id);


        return $topic;
    }


    // Asegurarse que tienen el campo created_at, el código sería así de sencillo
    public function getLastTopics($limit = 5)
    {
        return $this->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    //                      _ 
    //                     | |
    //   ___ _ __ _   _  __| |
    //  / __| '__| | | |/ _` |
    // | (__| |  | |_| | (_| |
    //  \___|_|   \__,_|\__,_|


    /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function crearCategoria()
    {
        /*         // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();

        $user = new User([
            'username' => 'foo-bar',
            'email'    => '[email protected]',
            'password' => 'secret plain text password',
        ]);

        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user); */
    }
}
