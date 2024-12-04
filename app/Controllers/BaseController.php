<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{

    /**ox
    
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];


    /**
     * Almacenará la instancia de Twig
     */
    protected $twig;

    // Aside info
    protected $trendingSubcategories;
    protected $mostVisitedTopics;
    protected $lastTopics;
    protected $todayTopic;

    protected $adUrl;

    protected $legalInfo;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->twig = \Config\Services::twig(); // Cualquier controlador tendrá acceso a twig automáticamente

        // Aside info
        $subcategoriesModel = model('SubcategoriesModel');
        $this->trendingSubcategories = $subcategoriesModel->getTrendingSubcategories(2);
        $this->mostVisitedTopics = $subcategoriesModel->getTrendingSubcategories();
        $this->lastTopics = $subcategoriesModel->getTrendingSubcategories();
        $this->todayTopic = $subcategoriesModel->getTrendingSubcategories();

        $this->adUrl = base_url() . 'images/ads/ad-' . rand(1,4) . '.png';

        $this->legalInfo = [
            'cookies' => [
                'text' => 'Política de cookies',
                'link' => base_url() . 'politica-de-cookies',
            ],
            'notice' => [
                'text' => 'Aviso legal',
                'link' =>  base_url() . 'aviso-legal',
            ],
            'privacy' => [
                'text' => 'Política de privacidad',
                'link' => base_url() . 'politica-de-privacidad',
            ],
        ];
    }
}
