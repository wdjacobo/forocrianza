<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class ProfileController extends BaseController
{


    public function show($profile_id)
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
        
        if ($users->findById($profile_id) === null) {
            throw new PageNotFoundException('No se ha podido encontrar el perfil con id "' . $profile_id . '".');
        }

        $data = [
            'title'     => "Perfil de username",
            'user' => $users->findById($profile_id),
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

    public function index_backup()
    {

        $categoriesModel = model('CategoriesModel');

        $data = [
            'title'     => 'Inicio',
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories()
        ];

        return view('templates/headerTemplate_backup', $data)
            . view('general/index_backup')
            . view('templates/footerTemplate_backup');
    }
}


/* <a class="text-decoration-none" href="<?= // Se usa iconv() para evitar problemas de caracteres en la URL: https://www.php.net/manual/es/function.iconv.php
                                        base_url() . str_replace(' ', '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $subcategory['title']))); ?>"><?= esc($subcategory['title']) ?></a>
 */