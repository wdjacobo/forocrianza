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

    protected $allowedFields = ['content'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
    public function getMessages($message_id = false)

    {
        if ($message_id === false) {
            return $this->findAll();
        }
        return $this->find($message_id);
    }


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
}
