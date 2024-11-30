<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use App\Models\SubcategoriasModel;


class CategoriasModel extends Model
{
    protected $table = 'categorias';
    protected $allowedFields = ['titulo'];


    // Cargar el modelo de subcategorías en el constructor
    protected $subcategoriasModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de subcategorías
        $this->subcategoriasModel = model('SubcategoriasModel') ();
    }

    /**
     * 
     * With this code, you can perform two different queries.
     * You can get all news records, or get a news item by its id.
     * You might have noticed that the $slug variable wasn’t escaped before running the query;
     * Query Builder does this for you.
     * 
     * @param false|int $id
     *
     * @return array|null
     */
    public function getCategorias($id = false)

    {
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first(); // Creo que first aqui sobra.
    }

    //Esto podría adaptarlo para que busque en todas las categorias o solo la de la id proporcionada, como en getCategorias.
    /**
     * Obtener todas las categorías con sus subcategorías
     * 
     * @return array
     */
    public function getCategoriasWithSubcategorias($id = false)
    {

        if ($id === false) {

            // Obtener todas las categorías
            $categorias = $this->findAll();

            // Para cada categoría, obtener sus subcategorías
            foreach ($categorias as &$categoria) {
                // Obtener subcategorías asociadas a esta categoría
                $categoria['subcategorias'] = $this->subcategoriasModel->getSubcategoriasByCategoria($categoria['id']);
            }


            return $categorias;
        }

        $categoria = $this->where(['id' => $id])->first();
        $categoria['subcategorias'] = $this->subcategoriasModel->getSubcategoriasByCategoria($categoria['id']);


        return $categoria;
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
