<?php

namespace App\Models;

use CodeIgniter\Model;


class SubcategoriasModel extends Model
{
    protected $table = 'subcategorias';
    protected $allowedFields = ['titulo', 'descripcion', 'id_categoria'];


    /**
     * Obtener subcategorías por id_categoria
     * 
     * @param int $id_categoria
     * @return array
     */
    public function getSubcategoriasByCategoriaId($id_categoria)
    {
        return $this->where('id_categoria', $id_categoria)->findAll();
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
    public function getCategorias($id = false)

    {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['titulo' => $id])->first();
    }






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
