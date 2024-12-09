<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class ProfileController extends BaseController
{


    /**
     * Muestra la página de inicio.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function show($profile_username)
    {

        // El proveedor de usuarios por defecto, UserModel
        $users = auth()->getProvider();

        // Formas de acceder a la información
        $user = $users->findById(1);
        $user = $users->findByCredentials(['email' => 'jacobo@admin.com']);
        $userArray = $user->toArray();
        $user->email;

        //var_dump($userArray['username']); exit();
        //var_dump($user); exit();

        if ($users->findById($profile_username) === null) {
            throw new PageNotFoundException('No se ha podido encontrar el perfil "' . $profile_username . '".');
        }

        $data = [
            'title'     => "Perfil de username",
            'user' => $users->findById($profile_username),
        ];

        return view('templates/headerTemplate', $data)
            . view('general/profile')
            . view('templates/footerTemplate');

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('general/profile')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }


    public function index()
    {

        $categoriesModel = model('CategoriesModel');

        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories(),
            'ad_number' => rand(1, 4)
        ];

        return view('templates/headerTemplate', $data)
            . view('templates/asideTemplate')
            . view('general/index')
            . view('templates/adBannerTemplate')
            . view('templates/footerTemplate');
    }
}
