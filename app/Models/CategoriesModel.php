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

    //Esto lo uso? Es necesario¿?¿
    /**
     * Obtiene categorías.
     * 
     * @param int|null $category_id La ID de la categoría a obtener. Si es null, se obtendrán todas.
     * 
     * @return array|null Devuelve un array de categorías si se encuentran o null si no se encuentran.
     */
    public function getCategories(?int $categoryId = null): ?array
    {
        if ($categoryId === null) {
            return $this->orderBy('title', 'ASC')->findAll();
        }
        return $this->find($categoryId);
    }


    // Usar find()...
    public function _getSubcategories(int $categoryId): ?array
    {
        $resultArray = $this->select('subcategories.id AS subcategory_id, subcategories.title AS subcategory_title')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left')
            ->where('categories.id', $categoryId)
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
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left')
            ->join('topics', 'subcategories.id = topics.subcategory_id', 'left')
            ->where('topics.created_at IN (SELECT MAX(created_at) FROM topics WHERE subcategory_id = subcategories.id)') // Obtener el último tema creado por subcategoría
            ->orderBy('categories.title, subcategories.title')
            ->get()
            ->getResultArray();

        //Rehacer esto en el controller.... Como con los temas
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

        return array_values($categories);
    }


    public function getCategoriesWithSubcategories(): array
    {
        $result = $this->select('categories.id AS category_id, categories.title AS category_title, 
                        subcategories.id AS subcategory_id, subcategories.title AS subcategory_title, subcategories.slug AS subcategory_slug')
            ->join('subcategories', 'categories.id = subcategories.category_id', 'left')
            ->orderBy('categories.title, subcategories.title')
            ->get()
            ->getResultArray();


        //Rehacer esto en el controller.... Como con los temas
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

        return array_values($categories);
    }
}
