<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;


class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title'];


    // Cargar el modelo de subcategorías en el constructor
    protected $subcategoriesModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de subcategorías
        $this->subcategoriesModel = model('SubcategoriesModel');
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
    public function getCategories(?int $category_id = null) : ?array
    {
        if ($category_id === null) {
            return $this->findAll();
        }
        return $this->find($category_id);
    }


    /**
     * Obtener todas las categorías con sus subcategorías
     * 
     * @return array
     */
    public function getCategoriesWithSubcategories($category_id = false)
    {

        if ($category_id === false) {

            // Obtener todas las categorías
            $categories = $this->findAll();

            // Para cada categoría, obtener sus subcategorías
            foreach ($categories as &$category) {
                // Obtener subcategorías asociadas a esta categoría
                $category['subcategories'] = $this->subcategoriesModel->getSubcategoriesByCategory($category['id']);
            }


            return $categories;
        }

        $category = $this->find($category_id);
        $category['subcategories'] = $this->subcategoriesModel->getSubcategoriesByCategory($category_id);


        return $category;
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
