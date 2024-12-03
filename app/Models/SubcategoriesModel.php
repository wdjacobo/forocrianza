<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;


class SubcategoriesModel extends Model
{
    protected $table = 'subcategories';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'description', 'category_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


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
    public function getSubcategoryBySlug($subcategory_slug)

    {
        $resultArray = $this->select('subcategories.*')
            ->where('subcategories.slug', $subcategory_slug)
            ->get()
            ->getResultArray();

        return $resultArray;
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

    public function getTitle($slug): string
    {
        // Realizamos la consulta para obtener las categorías y subcategorías
        $resultArray = $this->select('subcategories.title')
            ->where('subcategories.slug', $slug)
            ->get()
            ->getResultArray();

        return $resultArray[0]['title'];
    }


    /**
     * Obtiene categorías y sus subcategorías.
     * Puede realizar dos acciones:
     *  - Búsqueda por ID si se pasa como parámetro
     *  - Búsqueda de todas las categorías si no se pasa un ID como parámetro
     * 
     * @param int|null $category_id La ID de la categoría a obtener. Si es null, se obtendrán todas.
     * 
     * @return array|null Devuelve un array de categorías junto con sus subcategorías si se encuentran o null si no se encuentran.
     */
    public function getSubcategoryTopics($slug): array
    {
        // Realizamos la consulta para obtener las categorías y subcategorías
        $resultArray = $this->select('topics.title, topics.slug, users.username AS author')
            ->join('topics', 'subcategories.id = topics.subcategory_id', 'left')->orderBy('topics.id')
            ->join('users', 'topics.author_id = users.id', 'left')  // JOIN con users usando author_id
            ->where('subcategories.slug', $slug)
            ->get()
            ->getResultArray();

        //var_dump($resultArray); exit();

        return $resultArray;
    }





    // Asegurarse que tienen el campo created_at, el código sería así de sencillo
    public function getTrendingSubcategories($limit = 5)
    {
        return $this->select('subcategories.title, subcategories.slug, COUNT(topics.id) AS topic_count')
        ->join('topics', 'topics.subcategory_id = subcategories.id', 'left') // Unimos subcategories con topics
        ->groupBy('subcategories.id') // Agrupamos por subcategoría
        ->orderBy('topic_count', 'DESC') // Ordenamos por número de temas, descendente
        ->limit($limit) // Limitar el número de resultados
        ->get()
        ->getResultArray();
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
