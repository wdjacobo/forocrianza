<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class MainController extends BaseController
{

    /**
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function index()
    {
        $categoriesModel = model('CategoriesModel');

        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategoriesAndLastTopic(),
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


    /**
     * Lanza una excepciones de página de error 404.
     *
     * @throws PageNotFoundException 
     * 
     * @return void No retorna nada
     */
    public function notFound(): void
    {
        throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
    }

























































































































































































































































































































































































































    /**
     * ???
     * 
     * @return string ???
     */
    public function interview(): string
    {
        return view('errors/show.html');
    }
}
