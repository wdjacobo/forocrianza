<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;


class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title'];

    //Esto lo uso? Es necesario¿?¿
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


    public function _getSubcategories(int $category_id): ?array
    {
        $resultArray = $this->select('subcategories.id AS subcategory_id, subcategories.title AS subcategory_title')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left')
            ->where('categories.id', $category_id)
            ->orderBy('subcategories.title')
            ->get()
            ->getResultArray();

        return $resultArray;
    }


    public function getCategoriesWithSubcategoriesAndLastTopic(): array
    {
        // No obtendremos categorías que no tengan subcategorías
        $result = $this->select('categories.title AS category_title, 
        subcategories.title AS subcategory_title, 
        subcategories.description AS subcategory_description, 
        subcategories.slug AS subcategory_slug, 
        topics.title AS topic_title, 
        topics.slug AS topic_slug, 
        topics.created_at AS topic_created_at')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left') // Relación categorías -> subcategorías
            ->join('topics', 'subcategories.id = topics.subcategory_id', 'left') // Relación subcategorías -> temas
            ->where('topics.created_at IN (SELECT MAX(created_at) FROM topics WHERE subcategory_id = subcategories.id)') // Obtener el último tema creado por subcategoría
            ->orderBy('categories.title, subcategories.title')
            ->get()
            ->getResultArray();

        //Verme bien como hago esto
        // Agrupamos los resultados
        $categories = [];
        foreach ($result as $row) {
            $categoryTitle = $row['category_title'];
            if (!isset($categories[$categoryTitle])) {
                $categories[$categoryTitle] = [
                    'title' => $categoryTitle,
                    'subcategories' => [],
                ];
            }

            if ($row['subcategory_title'] !== null) {
                $categories[$categoryTitle]['subcategories'][] = [
                    'title' => $row['subcategory_title'],
                    'description' => $row['subcategory_description'],
                    'slug' => $row['subcategory_slug'],
                    'last_topic' => [
                        'title' => $row['topic_title'],
                        'slug' => $row['topic_slug'],
                        'created_at' => $row['topic_created_at'],
                    ],
                ];
            }
        }

        //Verme bien como hago esto, porque uso array values.
        // Reindexar como array secuencial para tener una lista de categorías
        return array_values($categories);
    }


    public function getCategoriesWithSubcategories(): array
    {
        $result = $this->select('categories.id AS category_id, categories.title AS category_title, 
                        subcategories.id AS subcategory_id, subcategories.title AS subcategory_title, subcategories.slug AS subcategory_slug')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left') // Relación categorías -> subcategorías
            ->orderBy('categories.title, subcategories.title')
            ->get()
            ->getResultArray();


        // Agrupar los resultados por categoría
        $categories = [];
        foreach ($result as $row) {
            $categoryId = $row['category_id'];

            // Si no existe la categoría en el array, la inicializamos
            if (!isset($categories[$categoryId])) {
                $categories[$categoryId] = [
                    'id' => $categoryId,
                    'title' => $row['category_title'],
                    'subcategories' => [],
                ];
            }

            // Si la subcategoría existe, la agregamos al array de subcategorías
            if ($row['subcategory_id'] !== null) {
                $categories[$categoryId]['subcategories'][] = [
                    'id' => $row['subcategory_id'],
                    'title' => $row['subcategory_title'],
                    'slug' => $row['subcategory_slug'],
                ];
            }
        }

        // Reindexar para devolver un array secuencial (opcional)
        return array_values($categories);
    }
}
