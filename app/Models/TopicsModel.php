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
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'opening_message', 'slug', 'subcategory_id', 'author_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    public function getTopicBySlug($topicSlug)

    {
        $resultArray = $this->select('topics.*')
            ->where('topics.slug', $topicSlug)
            ->get()
            ->getResultArray();

        return $resultArray;
    }


    //
    public function create($data)

    {
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

        // Generamos slug a partir del título eliminando espacios y caracteres especiales, separado por guiones, en minúscula, junto con el ID del tema, garantizando unicidad
        $slug = mb_url_title($topic['title'], '-', true) . "-$topicId";

        // Actualizamos el tema con el slug correcto
        $this->update($topicId, ['slug' => $slug]);

        // Completa la transacción
        $this->db->transComplete();

        //Se realiza un rollback automático si falla!

        // Verifica si la transacción fue exitosa
        return $this->db->transStatus();
    }

    public function getTopics($topic_id = false)

    {
        if ($topic_id === false) {
            return $this->findAll();
        }
        return $this->find($topic_id);
    }



    public function getTopicMessagesBySlug($topicSlug): array
    {
        // Esta consulta facela en MessagesModel en base ao topic!!
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
            ->join('users AS topic_author', 'topic_author.id = topics.author_id', 'left')
            ->join('users_info AS topic_author_info', 'topic_author_info.id = topic_author.id', 'left')
            ->join('messages', 'topics.id = messages.topic_id', 'left')
            ->join('users AS message_author', 'message_author.id = messages.author_id', 'left')
            ->join('users_info AS message_author_info', 'message_author_info.id = message_author.id', 'left')
            ->where('topics.slug', $topicSlug)
            ->orderBy('messages.created_at', 'ASC')
            ->get()
            ->getResultArray();
        return $resultArray;
    }



    /**
     * Obtiene todos los temas asociados a una subcategoría especificada por su ID
     * 
     * @param string $subcategoryId El ID de la subcategoría cuyos temas se desean obtener.
     * 
     * @return array Un array con los temas asociados a la subcategoría
     */
    public function getTopicsBySubcategory(string $subcategoryId): array
    {
        return $this->select('topics.title, topics.slug, users.username AS author, COUNT(messages.id) AS message_count, MAX(messages.created_at) AS last_message_date')
            ->join('subcategories', 'subcategories.id = topics.subcategory_id', 'left')
            ->join('users', 'users.id = topics.author_id', 'left')
            ->join('messages', 'messages.topic_id = topics.id', 'left')
            ->where('topics.subcategory_id', $subcategoryId)
            ->groupBy('topics.id')
            ->orderBy('topics.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getTopicInfo(string $topicId): array
    {
        return $this->select('topics.*, users.username AS author_username')
            ->join('users', 'users.id = topics.author_id', 'left')
            ->where('topics.id', $topicId)
            ->get()
            ->getRowArray();
    }


    public function getTopicsbyUser(int $userId): array
    {
        return $this->select('topics.id, topics.title, topics.slug AS topic_slug, topics.created_at, subcategories.slug AS subcategory_slug')
            ->join('subcategories', 'subcategories.id = topics.subcategory_id', 'left')
            ->where('topics.author_id', $userId)
            ->orderBy('topics.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }



    public function getLastTopics($limit = 5)
    {
        return $this->select('topics.title, topics.slug AS topic_slug, topics.created_at, subcategories.slug AS subcategory_slug')
            ->join('subcategories', 'topics.subcategory_id = subcategories.id', 'left')
            ->orderBy('topics.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }


    public function getMostCommentedTopics($limit = 5)
    {
        return $this->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    public function getTopicsWithMostMessages($limit = 5)
    {
        return $this->select('topics.title, topics.slug AS topic_slug, subcategories.slug AS subcategory_slug, COUNT(messages.id) as message_count')
            ->join('messages', 'topics.id = messages.topic_id', 'left')
            ->join('subcategories', 'topics.subcategory_id = subcategories.id', 'left')
            ->groupBy('topics.id')
            ->orderBy('message_count', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }
}
