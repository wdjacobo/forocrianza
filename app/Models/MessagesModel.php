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
    public function getMessagesByTopic(string $topic_id): array
    {
        return $this->select('messages.*, users.username AS author_username') // Seleccionamos todos los campos de messages y el campo username de users
            ->join('users', 'users.id = messages.author_id', 'left') // Relacionamos los mensajes con los usuarios (autores)
            ->where('messages.topic_id', $topic_id) // Filtro por el ID del tema
            ->orderBy('messages.created_at', 'ASC') // Ordenamos los mensajes por fecha de creación (puedes cambiar el orden si lo prefieres)
            ->get()
            ->getResultArray(); // Devuelve todos los mensajes asociados al tema como un array
    }


    public function getUserMessages(int $userId)
    {
        return $this->select('messages.id, messages.content, messages.created_at, messages.topic_id')
            ->where('messages.author_id', $userId) // Filtrar por ID de autor
            ->orderBy('messages.created_at', 'DESC') // Ordenar por fecha de creación descendente
            ->get()
            ->getResultArray();
    }
}
