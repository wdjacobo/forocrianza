<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Shield\Entities\User;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';

    /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function getUsuario($id = false)
    {



        if ($id === false) {
            return $this->findAll();
        }

        $users = auth()->getProvider();
        // Find by the user_id
        $user = $users->findById($id);
        return $user;

        return $this->where(['id' => $id])->first();
    }

    /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function crearUsuario()
    {
        // Get the User Provider (UserModel by default)
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
        $users->addToDefaultGroup($user);
    }
}
