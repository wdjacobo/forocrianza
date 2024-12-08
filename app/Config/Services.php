<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    // Actualmente no se está utilizando Twig
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function twig($viewDir = null, $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('twig', $viewDir);
        }

        $appPaths = new \Config\Paths();
        $appViewPaths = $viewDir ?? $appPaths->viewDirectory;

        // Comprobueba si estamos en entorno de desarrollo
        $isDevelopment = getenv('CI_ENVIRONMENT') === 'development';

        $loader = new \Twig\Loader\FilesystemLoader($appViewPaths);

        return new \Twig\Environment($loader, [
            'cache' => $isDevelopment ? false : WRITEPATH . '/cache/twig',  // Si estamos en entornos de desarrollo se desactiva la caché
            'auto_reload' => $isDevelopment,  // Para que Twig recargue las plantillas al detectar cambios
        ]);
    }
}
