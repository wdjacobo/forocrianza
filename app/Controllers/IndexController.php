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
        //var_dump($this->legalInfo);die();

        //Podría mandar un array con 'aside_info' que contuviese todas las infos, y así en la vista poder recorrer en un sólo bucle. Si no está la sesión iniciada, simplemente no se manda el de sesión.
        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories(),
            'trending_subcategories' => $this->trendingSubcategories,
            'mostVisitedTopics' => $this->mostVisitedTopics,
            'mostVisitedTopics' => $this->lastTopics,
            'mostVisitedTopics' => $this->mostVisitedTopics,
            'mostVisitedTopics' => $this->todayTopic,
            'legal_info' => $this->legalInfo,
            'ad_url' => $this->adUrl,
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