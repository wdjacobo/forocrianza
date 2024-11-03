<?php

namespace App\Controllers;

class UsuariosController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
