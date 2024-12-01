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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- En caso de querer añadir fallback -->
    <!--     <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
    <!--     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" onerror="fallbackBootstrapcss()">    
<script>
        function fallbackBootstrapcss() {
            console.error('CDN de Bootstrap no cargó. Usando recurso local.');
            // Cargar el archivo CSS local
            const fallbackLink = document.createElement('link');
            fallbackLink.rel = 'stylesheet';
            fallbackLink.href = '/css/bootstrap.min.css'; Habería que meter o base_url
            document.head.appendChild(fallbackLink);
        }
    </script> -->
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
</head>

<body>
    <header class="">
        <div class="container d-flex flex-wrap align-items-center justify-content-start p-0">
            <a href="/prueba">
                <img src="<?= base_url() ?>/images/logo/foro.png" alt="" srcset="" width="80" height="80">
            </a>

            <h1 class="m-0 ms-2"><a href="/prueba" class="text-reset text-decoration-none">ForoCrianza</a></h1>

        </div>
        <div class="container p-0">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-center py-3 mb-4 border-bottom">

                <nav>
                    <form class="me-3" role="search">
                        <input type="search" class="form-control" placeholder="Buscar temas..." aria-label="Search">
                    </form>
                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

                    </ul>
                </nav>
                <div class="d-flex align-items-center ms-auto">

                    <?php if (auth()->loggedIn()): ?>
                        <!--             Lo que sería el círculo de perfil del usuario -->
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <!--                                 <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle"> -->
                            </a>
                            <ul class="dropdown-menu text-small pb-0">
                                <li><a class="dropdown-item" href="#">Crear tema</a></li>
                                <li>
                                    <hr class="dropdown-divider m-0">
                                </li>
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Configuración</a></li>
                                <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
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