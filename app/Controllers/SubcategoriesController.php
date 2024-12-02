<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class SubcategoriesController extends BaseController
{

    public function show($slug)
    {
        $subcategoriesModel = model('SubcategoriesModel');
        //$subcategoriesModel->getSubcategory($slug)

        $subcategoriesModel->getSubcategoryTopics();

        $subcategory = [
            'topics' => [],
        ];

        $data = [
            'title'     => $slug, //$subcategoriesModel->getTitle($slug),
            'topics_list' => [],
            'slug' => $slug,
            'news' => null,
            'subcategory_title' => $subcategoriesModel->getTitle($slug),
            'subcategory_topics' => $subcategoriesModel->getSubcategoryTopics(),
        ];

        // Sería si no existe categoría asociada a ese slug
        if (false) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "' . $slug . '".');
        }

        return view('templates/headerTemplate', $data)
            . view('general/subcategory')
            . view('templates/footerTemplate');
    }
}
