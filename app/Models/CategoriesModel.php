<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;


class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title'];

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

    // Cargar el modelo de subcategorías en el constructor
    protected $subcategoriesModel;

    public function __construct()
    {
        parent::__construct();
        // Instanciamos el modelo de subcategorías
        $this->subcategoriesModel = model('SubcategoriesModel');
    }

    /**
     * Obtiene categorías.
     * Puede realizar dos acciones:
     *  - Búsqueda por ID si se pasa como parámetro
     *  - Búsqueda de todas las categorías si no se pasa un ID como parámetro
     * 
     * @param int|null $category_id La ID de la categoría a obtener. Si es null, se obtendrán todas.
     * 
     * @return array|null Devuelve un array de categorías si se encuentran o null si no se encuentran.
     */
    public function getCategories(?int $category_id = null): ?array
    {
        if ($category_id === null) {
            return $this->orderBy('title', 'ASC')->findAll();
        }
        return $this->find($category_id);
    }


    public function getSubcategories(int $category_id): ?array
    {
        $resultArray = $this->select('subcategories.id AS subcategory_id, subcategories.title AS subcategory_title')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left')
            ->where('categories.id', $category_id)
            ->orderBy('subcategories.title')
            ->get()
            ->getResultArray();

        return $resultArray;
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
    public function getCategoriesWithSubcategories(): array
    {
        // Realizamos la consulta para obtener las categorías y subcategorías
        $resultArray = $this->select('categories.id AS category_id, categories.title AS category_title, subcategories.id AS subcategory_id, subcategories.title AS subcategory_title, subcategories.description AS subcategory_description, subcategories.slug AS subcategory_slug, subcategories.category_id AS subcategories_category_id')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left')->orderBy('categories.title, subcategories.title')
            ->get()
            ->getResultArray();

        // Formateamos los resultados para anidar las subcategorías en las categorías

        return $this->formatCategoriesWithSubcategories($resultArray);
    }

    protected function formatCategoriesWithSubcategories(array $data): array
    {
        $categories = [];

        foreach ($data as $row) {
            $categoryId = $row['category_id'];

            // Inicializamos la categoría si no existe en el array
            if (!isset($categories[$categoryId])) {
                $categories[$categoryId] = [
                    'id' => $categoryId,
                    'title' => $row['category_title'],
                    'subcategories' => []  // Iniciamos un array para las subcategorías
                ];
            }

            // Agregar subcategoría si existe
            if ($row['subcategory_id'] !== null) {
                $categories[$categoryId]['subcategories'][] = [
                    'id' => $row['subcategory_id'],
                    'title' => $row['subcategory_title'],
                    'description' => $row['subcategory_description'],
                    'slug' => $row['subcategory_slug'],
                    'categoryId' => $row['subcategories_category_id'],
                ];
            }
        }

        // Retornamos el array con las categorías y sus subcategorías
        return array_values($categories);
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
    public function _getCategoriesWithSubcategories(?int $category_id = null): ?array
    {

        if ($category_id === null) {
            $categories = $this->findAll();

            // Usamos &category para modificar y guardar los cambios en el elemento original del array
            foreach ($categories as &$category) {

                // Se obtienen las subcategorías asociadas a esta categoría
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




    public function create($data)

    {
        //Falta obtener el author_id
        /*         echo "Datos validados pasados al modelo:<br><br>";
        var_dump($data);
        exit();
 */
        // Se inicia una transacción para asegurarnos de que todo sale correctamente con la generación del slug y el update
        $this->db->transStart();

        //Guardamos el tema con un placeholder en el slug
        // Insertamos el registro y almacenamos su ID
        $topicId = $this->insert(
            [
                'title' => $data['topic-title'],
                'opening_message' => $data['topic-opening-message'],
                'slug' => $data['topic-title'] . rand(0, 1000),
                'subcategory_id' => $data['subcategory'],
                'author_id' => $data['author-id'],
            ]
        );
        $topic = $this->find($topicId);

        /*         $topic = $this->find($topicId);
        echo "<br><br><br><br>Tema insertado:<br><br>";
        var_dump($topic); //exit(); */

        // Generamos slug a partir del título eliminando espacios y caracteres especiales, separado por guiones, en minúscula, junto con el ID del tema, garantizando unicidad
        $slug = mb_url_title($topic['title'], '-', true) . "-$topicId";

        // Actualizamos el tema con el slug correcto
        $this->update($topicId, ['slug' => $slug]);

        //$topic = $this->find($topicId);

        /*         echo "<br><br><br><br>Tema insertado con slug nueva:<br><br>";
        $topic = $this->find($topicId);
        var_dump($topic); exit(); */


        // Completa la transacción
        $this->db->transComplete();

        //Se realiza un rollback automático si falla.

        //retornar el transStatus mejor, indicando si hubo fallo o éxito.

        // Verifica si la transacción fue exitosa

        return $this->db->transStatus();
    }
























    /**
     * Guarda una categoría en la base de datos.
     * 
     * Gracias al método save(), puede realizar dos acciones en función del si se pasa o no el parámetro `$category_id`:
     * - Si se pasa actúa como un UPDATE.
     * - Si no se pasa actúa como un INSERT.
     * 
     * @param string $title título de la categoría.
     * @param int|null $category_id ID de la categoría a actualizar. Si es null, se inserta una nueva categoría.
     * 
     * @return void No devuelve nada.
     */
    public function saveCategory(string $title, ?int $category_id = null)
    {
        $category_fields = ['title' => $title];

        if ($category_id !== null) {
            $category_fields = ['id' => $category_id];
            // Si hay category_id haría update, y sino hace insert
        }
        // Comprobar que se aplica
        $this->save($category_fields);
    }



    /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function deleteCategory($category_id)
    {
        //If the model’s $useSoftDeletes value is true, this will update the row to set deleted_at to the current date and time. You can force a permanent delete by setting the second parameter as true.
        //An array of primary keys can be passed in as the first parameter to delete multiple records at once:
        if ($category_id !== null) {
            $category_fields = ['id' => $category_id];
            // Si hay category_id haría update, y sino hace insert
        }
        // Comprobar que se aplica
        $this->delete($category_id);
    }
}
