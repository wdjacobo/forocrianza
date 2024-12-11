<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

// Cambiado el UserProvider en Auth.php
class UserModel extends ShieldUserModel
{

    protected $useSoftDeletes = false; // Desactivamos soft deletes

    public function getUserTopics(int $user_id): array
    {
        // Comprobar que devuelve bien... mensajes!
        return $this->select('topics.title, topics.slug AS topic_slug, subcategories.slug AS subcategory_slug, COUNT(messages.id) AS total_messages')
            ->join('topics', 'users.id = topics.author_id', 'left')
            ->join('subcategories', 'subcategories.id = topics.subcategory_id', 'left')
            ->join('messages', 'users.id = messages.author_id ', 'left')
            ->where('users.id', $user_id)
            ->groupBy('topics.id')
            ->orderBy('topics.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
