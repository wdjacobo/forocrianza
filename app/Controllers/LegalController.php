<?php

declare(strict_types=1);

namespace App\Controllers;


class LegalController extends BaseController
{

    /**
     * Muestra la página de la política de cookies.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function showCookiesPolicy()
    {
        $data = [
            'title'     => 'Política de cookies',
        ];

        return view('legal/cookie_policy', $data);
    }

    /**
     * Muestra la página de la política de aviso legal.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function showLegalNotice()
    {
        $data = [
            'title'     => 'Aviso legal',
        ];

        return view('legal/legal_notice', $data);
    }

    /**
     * Muestra la página de la política de privacidad.
     * 
     * Prepara los datos necesarios y renderiza la vista de la página.
     * 
     * @return string la renderización de la vista correspondiente.
     */
    public function showPrivacyPolicy()
    {
        $data = [
            'title'     => 'Política de privacidad',
        ];

        return view('legal/privacy_policy', $data);
    }
}
