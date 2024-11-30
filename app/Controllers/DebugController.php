<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class DebugController extends BaseController
{

    public function debug()
    {



        $categoriesModel = model('CategoriesModel');
        $subcategoriesModel = model('SubcategoriesModel');
        $topicsModel = model('TopicsModel');
        $messagesModel = model('MessagesModel');



        $data = [
            'categories_list' => $categoriesModel->getCategoriesWithSubcategories(),
            'unic_category' => $categoriesModel->getCategoriesWithSubcategories(3),
            'unic' => $categoriesModel->getCategories(2),
            '' => '',
            '' => '',
        ];

        return view('general/debug', $data);
    }
}
