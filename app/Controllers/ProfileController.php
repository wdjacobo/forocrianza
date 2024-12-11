<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class ProfileController extends BaseController
{
    /**
     * Muestra la página de perfil de un usuario en base a su nombre de usuario.
     * 
     * @param string El nombre de usuario del perfil que queremos ver.
     * 
     * @return string La renderización de la vista correspondiente.
     */
    public function index($username)
    {
        $users = auth()->getProvider();
        $user = $users->findByCredentials(['username' => $username]);

        if (!$user) {
            throw new PageNotFoundException('No se ha podido encontrar el perfil de "' . $username . '".');
        }

        $user = $user->toArray();
        // Pasamos la fecha a un formato más adecuado (F no está funcionando en español por algún motivo)
        $user['created_at'] = $user['created_at']->format('d \d\e\l m \d\e Y');




        $data = [
            'title'     => $username,
            'user' => $user,
            'user_topics' => $users->getUserTopics($user['id']),
            'trending_subcategories' => $this->trendingSubcategories,
            'last_topics' => $this->lastTopics,
            'topics_with_most_messages' => $this->topicsWithMostMessages,
            'ad_urls' => $this->adUrls,
        ];

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('templates/asideModalTemplate')
            . view('profile/index')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }


    public function _index()
    {

        $categoriesModel = model('CategoriesModel');

        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories(),
            'ad_number' => rand(1, 4)
        ];

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('templates/asideModalTemplate')
            . view('general/index')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }
}
