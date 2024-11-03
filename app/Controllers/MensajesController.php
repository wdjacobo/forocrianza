<?php

namespace App\Controllers;

class MensajesController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
