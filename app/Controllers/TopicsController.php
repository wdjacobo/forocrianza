<?php
declare(strict_types=1);

namespace App\Controllers;

class TopicsController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
