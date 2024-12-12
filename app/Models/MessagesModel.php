<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['content', 'author_id', 'topic_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    /**
     * Obtiene toda la información de los mensajes asociados a un tema específico.
     * 
     * @param string $topic_id El ID del tema cuyos mensajes se desean obtener.
     * 
     * @return array Un array con toda la información de los mensajes asociados al tema.
     */
    public function getMessagesByTopic(string $topicId): array
    {
        return $this->select('messages.*, users.username AS author_username')
            ->join('users', 'users.id = messages.author_id', 'left') 
            ->where('messages.topic_id', $topicId)
            ->orderBy('messages.created_at', 'ASC')
            ->get()
            ->getResultArray();
    }


    /**
     * Obtiene los mensajes de un usuario específico
     * 
     * @param int $userId ID del usuario
     * 
     * @return array Un array con toda la información de los mensajes del usuario
     */
    public function getUserMessages(int $userId): array
    {
        return $this->select('messages.id, messages.content, messages.created_at, messages.topic_id')
            ->where('messages.author_id', $userId)
            ->orderBy('messages.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
