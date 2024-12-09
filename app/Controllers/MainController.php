<?php

declare(strict_types=1);

namespace App\Controllers;

class MainController extends BaseController
{
    //Comentarios a corregir


    // Eliminar
    public function giveAdminAccess()
    {
        $user = auth()->user();
        $user->addPermission('admin.access');
        return redirect()->to(base_url());
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
