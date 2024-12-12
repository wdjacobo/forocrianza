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
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'description', 'category_id', 'slug'];


    public function getSubcategoryTopics(string $subcategoryId): array
    {
        return $this->select('
        topics.title, 
        topics.slug, 
        users.username AS author, 
        COUNT(messages.id) AS total_messages, 
        MAX(messages.created_at) AS last_message_date
    ')
            ->join('topics', 'subcategories.id = topics.subcategory_id', 'left')
            ->join('users', 'topics.author_id = users.id', 'left')
            ->join('messages', 'topics.id =messages.topic_id', 'left')
            ->where('subcategories.id', $subcategoryId)
            ->groupBy('topics.id') // Agrupación para el uso de COUNT y MAX
            ->orderBy('topics.created_at', 'DESC')
            ->get()
            ->getResultArray();


            
    }

    /**
     * Obtiene los últimos temas de una subcategoría concreta ordenados por fecha de creación.
     * 
     * @param string $subcategory_slug El slug de la subcategoría
     * @param int $limit Máximo de resultados a obtener
     * 
     * @return array Array de temas 
     */
    public function getSubcategoryLastTopics(string $subcategorySlug, int $limit = 5): array
    {
        return $this->select('topics.title, topics.slug AS topic_slug, topics.created_at, subcategories.slug AS subcategory_slug')
            ->join('topics', 'subcategories.id = topics.subcategory_id', 'left')
            ->where('subcategories.id', $subcategorySlug)
            ->orderBy('topics.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    
    public function getTrendingSubcategories($limit = 5)
    {
        return $this->select('subcategories.title, subcategories.slug, COUNT(topics.id) AS topic_count')
            ->join('topics', 'topics.subcategory_id = subcategories.id', 'left') // Unimos subcategories con topics
            ->groupBy('subcategories.id')
            ->orderBy('topic_count', 'DESC')
            ->limit($limit) 
            ->get()
            ->getResultArray();
    }



    public function getSubcategoriesByCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
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


    public function getSubcategoryBySlug($subcategorySlug)

    {
        $resultArray = $this->select('subcategories.*')
            ->where('subcategories.slug', $subcategorySlug)
            ->get()
            ->getResultArray();

        return $resultArray;
    }
}
