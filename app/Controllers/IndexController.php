<?php

declare(strict_types=1);

namespace App\Controllers;

class IndexController extends BaseController
{
    public function index()
    {
        // Corregir
        $categoriesModel = model('CategoriesModel');

        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories(), // Corregir esto
            'trending_subcategories' => $this->trendingSubcategories,
            'last_topics' => $this->lastTopics,
            'topics_with_most_messages' => $this->topicsWithMostMessages,
            'ad_urls' => $this->adUrls,
        ];

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('templates/asideModalTemplate')
            . view('general/index')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }
}
