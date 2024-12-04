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
    <header class="container my-4 p-0 pb-4 border-bottom">
        <div class="row mb-3" name="imagotype-container">
            <div class="col-12 d-flex justify-content-center justify-content-lg-start">
                <a href="<?= url_to('index') ?>">
                    <img src="<?= base_url() ?>images/brand/imagotipo-forocrianza.png" alt="Imagotipo del sitio web ForoCrianza">
                </a>
            </div>
        </div>



        <nav class="row d-flex flex-wrap justify-content-md-between">

            <form class="d-flex" role="search">
                <input type="search" class="form-control" placeholder="Buscar temas..." aria-label="Search">

                <input class="btn btn-primary" type="submit" value="Submit">

            </form>

            <a class="btn btn-primary" href="<?= url_to('legal-notice') ?>" role="button">Crear tema</a>



            <div class="d-flex align-items-center ms-auto">

                <?php if (auth()->loggedIn()): ?>

                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span><?= auth()->user()->username ?></span>
                        </a>

                        <ul class="dropdown-menu text-small pb-0">
                            <li><a class="dropdown-item" href="/tema">Crear tema</a></li>
                            <li>
                                <hr class="dropdown-divider m-0">
                            </li>
                            <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                            <li><a class="dropdown-item" href="/perfil">Configuración</a></li>
                            <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                        </ul>
                    </div>


                <?php else: ?>


                        <a href="<?= base_url() ?>iniciar-sesion"><button type="button" class="btn btn-outline-primary me-2">Iniciar sesión</button></a>

                        <a href="registro"><button type="button" class="btn btn-primary">Registro</button></a>


                <?php endif; ?>



            </div>
        </nav>
    </header>