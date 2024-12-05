<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class DebugController extends BaseController
{
    // Cargamos los helpers que queramos
    protected $helpers = ['url', 'form'];

    public function debug()
    {

        // return print_r($this->request);
        // return print_r($this->response);
        // return print_r($this->logger);

        // Ver ejemplo de validate data en la función product
        //return $this->validateData($data, $rules); //https://codeigniter.com/user_guide/incoming/controllers.html#validating-data

        if (false) {
            throw new PageNotFoundException('No hemos podido encontrar el contenido que buscas.');
        }


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

    public function product(int $id)
    {
        $data = [
            'id'   => $id,
            'name' => $this->request->getPost('name'),
        ];

        $rule = [
            'id'   => 'integer',
            'name' => 'required|max_length[255]',
        ];

        if (! $this->validateData($data, $rule)) {
            return view('store/product', [
                'errors' => $this->validator->getErrors(),
            ]);
        }
    }


    public function breadcrumbs()
    {
        return view('general/breadcrumbs');
    }

    public function checkout()
    {
        return view('general/checkout');
    }
    public function buttons()
    {
        return view('general/buttons-alerts');
    }
    public function pagination()
    {
        return view('general/pagination');
    }
    public function user_form()
    {
        return view('general/user_form');
    }
    public function topic_form()
    {
        return view('general/topic_form');
    }






}
