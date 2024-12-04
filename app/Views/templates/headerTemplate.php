<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Forocrianza es el foro donde compartir y discutir con otros padres y madres experiencias sobre la crianza de nuestros hijos. Este foro contiene información útil para ayudar a las familias en el proceso de crianza de los niños y niñas.">
    <meta name="keywords" content="forocrianza, foro, crianza, foro para padres, foro sobre familia, foro sobre niños, foro sobre educacion, opiniones crianza, opiniones educacion">
    <title> <?php
            if ($_SERVER['REQUEST_URI'] === '/') {
                echo 'ForoCrianza';
            } else {
                if (isset($title)) {
                    echo $title . ' | ForoCrianza';
                }
            }
            ?></title>
    <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/ico">
    <script>
        /**
         * Carga el CSS local de Bootstrap si falla la CDN.
         * Crea un nuevo link para el CSS de Bootstrap local y mueve los estilos personalizados al final del elemento `<>` para permitir la sobreescritura de estilos de Bootstrap.
         */
        function loadLocalBootstrapCss() {
            console.warn("No se ha podido cargar el CSS de Bootstrap desde la CDN, se cargará el archivo local.");
            let fallbackLink = document.createElement('link');
            fallbackLink.rel = 'stylesheet';
            fallbackLink.href = '<?= base_url() ?>css/bootstrap.min.css';
            document.head.appendChild(fallbackLink);

            let customStyles = document.getElementById('customStyles');
            document.head.appendChild(customStyles);

        }
    </script>

    <!-- CSS de Bootstrap con fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" onerror="loadLocalBootstrapCss()">

    <!-- CSS personalizado -->
    <link id="customStyles" rel="stylesheet" href="<?= base_url() ?>css/style.css">
</head>

<body>
    <header class="container my-4 p-0 pb-2 border-bottom">
        <div class="row mb-lg-4 d-flex" name="imagotype-container">

            <div class="col-auto mb-4 mb-lg-0 col-lg-auto d-flex">
                <a href="<?= url_to('index') ?>">
                    <picture>
                        <!-- Para pantallas más pequeñas que 'lg' (menores a 768px) -->
                        <source media="(max-width: 767px)" srcset="<?= base_url() ?>images/brand/isotipo-forocrianza.png">
                        <!-- Para pantallas más pequeñas que 'lg' (menores a 992px) -->
                        <source media="(max-width: 991px)" srcset="<?= base_url() ?>images/brand/logotipo-forocrianza.png">
                        <!-- Para pantallas mayores o iguales a 'lg' (992px o más) -->
                        <img src="<?= base_url() ?>images/brand/imagotipo-forocrianza.png" alt="Imagotipo del sitio web ForoCrianza">
                    </picture>
                </a>
            </div>
            <div class="col-auto ms-auto d-flex col-auto mb-4 mb-lg-0 col-lg-auto d-flex ">
                <a class="btn btn-outline-primary me-2" href="<?= url_to('login') ?>" type="button" role="button">Iniciar sesión</a>
                <a class="btn btn-primary" href="<?= url_to('registro') ?>" type="button" role="button">Registro</a>
            </div>
        </div>
    </header>