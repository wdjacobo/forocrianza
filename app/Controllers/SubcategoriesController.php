<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class SubcategoriesController extends BaseController
{

    public function show($slug)
    {
        $subcategoriesModel = model('SubcategoriesModel');

        if ($subcategoriesModel->getSubcategoryBySlug($slug) === []) {
            throw new PageNotFoundException('No se ha podido encontrar la subcategoría "' . $slug . '".');
        }



        $data = [
            'title'     => $subcategoriesModel->getTitle($slug),
            'slug' => $slug,
            'subcategory_topics' => $subcategoriesModel->getSubcategoryTopics($slug),
            'ad_number' => rand(1, 4)
        ];


                    return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('subcategories/show')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }
}
