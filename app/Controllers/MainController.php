<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class MainController extends BaseController
{




    public function notFound()
    {
        throw new PageNotFoundException('Lo siento, no hemos podido encontrar lo que estabas buscando.');
    }


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
     * Muestra la página de inicio de sesión.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function login()
    {

        $data = [
            'title'     => 'Iniciar sesión',
        ];

        return view('Shield/login', $data);
    }


    /**
     * Muestra la página de registro.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function register()
    {
        $data = [
            'title'     => 'Registro',
        ];


        return view('Shield/register', $data);


        return view('templates/basic-header-template', $data)
            . view('Shield/register')
            . view('templates/basic-footer-template');
    }


























































































































































































































































































































































































































    /**
     * ???
     * 
     * @return string ???
     */
    public function interview()
    {
        return view('errors/show.html');
    }
}
