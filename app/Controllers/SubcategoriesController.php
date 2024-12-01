<?php
declare(strict_types=1);

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

class SubcategoriesController extends BaseController
{

    public function show(?string $slug = null)
    {
        $model = model('SubcategoriesModel');

        $data['news'] = $model->getNews($slug);

        if ($data['news'] === null) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }
    public function index(): string
    {
        return view('welcome_message');
    }
}
