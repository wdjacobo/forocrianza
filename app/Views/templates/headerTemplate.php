<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php
            if ($_SERVER['REQUEST_URI'] === '/prueba') {
                echo 'ForoCrianza';
            } else {
                if (isset($title)) {
                    echo $title . ' | ForoCrianza';
                }
            }
            ?></title>
    <link rel="icon" href="<?= base_url() ?>/favicon.ico" type="image/ico">

    <script>
        /**
         * Loads local Bootstrap CSS if CDN load fails.
         * Creates a new link for local Bootstrap CSS and moves custom stylesheets to the end of head element to allow Bootstrap styles overriding.
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
    <link rel="stylesheet" href="<?= base_url() ?>css/style.css" id="customStyles">
</head>

<body>
    <header class="">
        <div class="container d-flex flex-wrap align-items-center justify-content-start p-0">
            <a href="/">
                <img src="<?= base_url() ?>/images/logo/foro.png" alt="" srcset="" width="80" height="80">
            </a>

            <h1 class="m-0 ms-2"><a href="/" class="text-reset text-decoration-none">ForoCrianza</a></h1>

        </div>
        <div class="container p-0">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-center py-3 mb-4 border-bottom">
                <nav>
                    <form class="me-3" role="search">
                        <input type="search" class="form-control" placeholder="Buscar temas..." aria-label="Search">
                    </form>
                </nav>
                <div>
                    <a
                        name=""
                        id=""
                        class="btn btn-primary"
                        href="#"
                        role="button">Crear tema</a>
                </div>
                <div class="d-flex align-items-center ms-auto">

                    <?php if (auth()->loggedIn()): ?>
                        <!--             Lo que sería el círculo de perfil del usuario -->
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <!--                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> -->
                                <!--                                 <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle"> -->
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
                        <a href="iniciar-sesion"><button type="button" class="btn btn-outline-primary me-2">Iniciar sesión</button></a>
                        <a href="registro"><button type="button" class="btn btn-primary">Registro</button></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </header>