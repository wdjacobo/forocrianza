<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;


class SubcategoriesModel extends Model
{
    protected $table = 'subcategories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'description', 'category_id'];


    // Cargar el modelo de temas en el constructor
    protected $topicsModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de temas
        $this->topicsModel = model('TopicsModel');
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
    public function getSubcategories($subcategory_id = false)

    {
        if ($subcategory_id === false) {
            return $this->findAll();
        }
        return $this->find($subcategory_id);
    }

    /**
     * Obtener subcategorías por id_categoria
     * 
     * @param int $id_categoria
     * @return array
     */
    public function getSubcategoriesByCategory($category_id)
    {
        return $this->where('category_id', $category_id)->findAll();
    }


    /**
     * Obtener todas las categorías con sus subcategorías
     * 
     * @return array
     */
    public function getSubcategoriesWithTopics($subcategory_id = false)
    {
        if ($subcategory_id === false) {

            // Obtener todas las categorías
            $subcategories = $this->findAll();

            // Para cada categoría, obtener sus subcategorías
            foreach ($subcategories as &$subcategory) {
                // Obtener subcategorías asociadas a esta categoría
                $subcategory['topics'] = $this->topicsModel->getTopicsBySubcategory($subcategory['id']);
            }


            return $subcategories;
        }


        $subcategory = $this->find($subcategory_id);
        $subcategory['topics'] = $this->topicsModel->getTopicsBySubcategory($subcategory_id);


        return $subcategory;
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
