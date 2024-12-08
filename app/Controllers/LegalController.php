<?php

declare(strict_types=1);

namespace App\Controllers;


class LegalController extends BaseController
{

    public function showCookiesPolicy()
    {
        $data = [
            'title'     => 'Política de cookies',
        ];

        return view('legal/cookie_policy', $data);
    }

    public function showLegalNotice()
    {
        $data = [
            'title'     => 'Aviso legal',
        ];

        return view('legal/legal_notice', $data);
    }
    public function showPrivacyPolicy()
    {
        $data = [
            'title'     => 'Política de privacidad',
        ];

        return view('legal/privacy_policy', $data);
    }
}
