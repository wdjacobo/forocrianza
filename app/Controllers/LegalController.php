<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
//Usar este PageNotFoundException!

class LegalController extends BaseController
{

    public function showCookiesPolicy()
    {
        $data = [
            'title'     => 'Política de cookies',
            'legal_info' => $this->legalInfo,
        ];

        return view('templates/headerTemplate', $data)
            . view('legal/cookie_policy')
            . view('templates/footerTemplate');
    }

    public function showLegalNotice()
    {
        $data = [
            'title'     => 'Aviso legal',
            'legal_info' => $this->legalInfo,
        ];

        return view('templates/headerTemplate', $data)
            . view('legal/legal_notice')
            . view('templates/footerTemplate');
    }
    public function showPrivacyPolicy()
    {
        $data = [
            'title'     => 'Política de privacidad',
            'legal_info' => $this->legalInfo,
        ];

        return view('templates/headerTemplate', $data)
            . view('legal/privacy_policy')
            . view('templates/footerTemplate');
    }
}
