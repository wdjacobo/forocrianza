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
    protected $allowedFields = ['title', 'subcategory_id'];

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
