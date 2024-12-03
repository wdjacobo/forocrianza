<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class IndexController extends BaseController
{
    public function index()
    {

        $categoriesModel = model('CategoriesModel');
        $subcategoriesModel = model('SubcategoriesModel');


        //var_dump($trending_subcategories); die();

        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories(),
            'trending_subcategories' => $this->trendingSubcategories,
            'ad_number' => rand(1, 4)
        ];

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('general/index')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }
}

/* <a class="text-decoration-none" href="<?= // Se usa iconv() para evitar problemas de caracteres en la URL: https://www.php.net/manual/es/function.iconv.php
                                        base_url() . str_replace(' ', '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $subcategory['title']))); ?>"><?= esc($subcategory['title']) ?></a>
 */