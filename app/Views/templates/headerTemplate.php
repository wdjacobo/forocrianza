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

            let customStyles = document.getElementById('custom-styles');
            document.head.appendChild(customStyles);

        }
    </script>

    <!-- CSS de Bootstrap con fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" onerror="loadLocalBootstrapCss()">

    <!-- CSS personalizado -->
    <link id="custom-styles" rel="stylesheet" href="<?= base_url() ?>css/style.css">
</head>


<body>
    <div class="container">
        <header class="row d-flex mt-5 mb-4 pb-4 border-bottom">
            <div class="col-auto">
                <a href="<?= url_to('index') ?>">
                    <picture>
                        <!-- Pantallas más pequeñas que el breackpoint 'md' (< 768px) -->
                        <source media="(max-width: 767px)" srcset="<?= base_url() ?>images/brand/isotipo-forocrianza.png">
                        <!-- Pantallas más pequeñas que el breackpoint 'lg' (< 992px) -->
                        <source media="(max-width: 991px)" srcset="<?= base_url() ?>images/brand/logotipo-forocrianza.png">
                        <!-- Para pantallas mayores o iguales a 'lg' (992px o más) -->
                        <img src="<?= base_url() ?>images/brand/imagotipo-forocrianza.png" alt="Imagotipo del sitio web ForoCrianza">
                    </picture>
                </a>
            </div>
            <div class="col-auto ms-auto">
                <a class="btn btn-outline-primary me-2" href="<?= url_to('login') ?>" type="button" role="button">Iniciar sesión</a>
                <a class="btn btn-primary" href="<?= url_to('registro') ?>" type="button" role="button">Registro</a>
            </div>
        </header>