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


























    /**
     * Obtiene los temas de una subcategoría concreta ordenados por fecha de creación.
     * 
     * @param string $subcategory_slug El slug de la subcategoría cuyos temas se quieren obtener.todas.
     * 
     * @return array Array de temas con los campos 'title', 'topic_slug', 'author', 'message_number', 'last_message_date' y 'subcategory_slug'
     */
    public function getSubcategoryTopics(string $subcategory_slug): array
    {
        return $this->select('topics.title, topics.slug AS topic_slug, users.username AS author, 
        COUNT(messages.id) AS message_number, MAX(messages.created_at) AS last_message_date, 
        subcategories.slug AS subcategory_slug')
            ->join('subcategories', 'subcategories.id = topics.subcategory_id', 'left')
            ->join('users', 'users.id = topics.author_id', 'left')
            ->join('messages', 'messages.topic_id = topics.id', 'left')
            ->where('subcategories.slug', $subcategory_slug)
            ->groupBy('topics.id')  // Agrupación en función del tema para poder contar los mensajes
            ->orderBy('topics.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    //Podo facer isto para todas as subcategorias e agrupar por subcategoria para ter un array no que ter todo¿?

    /**
     * Obtiene los últimos temas de una subcategoría concreta ordenados por fecha de creación.
     * 
     * @param string $subcategory_slug El slug de la subcategoría cuyos temas se quieren obtener.
     * @param int $limit El número máximo de resultados a obtener, 5 por defecto.
     * 
     * @return array Array de temas con los campos 'title', 'topic_slug', 'created_at' y 'subcategory_slug'
     */
    public function getSubcategoryLastTopics(string $subcategory_slug, int $limit = 5): array
    {
        return $this->select('topics.title, topics.slug AS topic_slug, topics.created_at, subcategories.slug AS subcategory_slug')
            ->join('topics', 'subcategories.id = topics.subcategory_id', 'left')
            ->where('subcategories.id', $subcategory_slug)
            ->orderBy('topics.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Obtiene los temas de una subcategoría concreta ordenados por fecha de creación.
     * 
     * @param string $subcategory_slug El slug de la subcategoría cuyos temas se quieren obtener.todas.
     * 
     * @return array Array de temas con los campos 'title', 'topic_slug', 'author', 'message_number', 'last_message_date' y 'subcategory_slug'
     */
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
}
