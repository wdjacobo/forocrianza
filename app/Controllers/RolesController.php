<?php
declare(strict_types=1);

namespace App\Controllers;

class RolesController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
