<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($titulo)) echo $titulo ?></title>
    <title><?php if (isset($title)) echo $title ?></title>
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
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
</head>

<body class="bg-light">
    <header>
        <div class="container d-flex flex-wrap align-items-center justify-content-start">
            <img src="<?= base_url() ?>/images/logo/foro.png" alt="" srcset="" width="80" height="80">
            <h1 class="ms-2">Forocrianza</h1>
        </div>
        <div class="container p-0">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-center py-3 mb-4 border-bottom">

                <nav>
                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/" class="nav-link px-2 link-secondary">Inicio</a></li>
                        <li><a href="subcategoria" class="nav-link px-2">Subcategoría</a></li>
                        <li><a href="tema" class="nav-link px-2">Tema</a></li>
                        <!--                         <li><a href="blog" class="nav-link px-2">Blog</a></li>
                        <li><a href="blog-post" class="nav-link px-2">Blog-post</a></li> -->
                        <li><a href="perfil" class="nav-link px-2">Perfil</a></li>
                        <li><a href="admin-dash" class="nav-link px-2">Panel admin</a></li>
                    </ul>
                </nav>
                <div class="d-flex align-items-center ms-auto">
                    <form class="me-3" role="search">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <a href="iniciar-sesion"><button type="button" class="btn btn-outline-primary me-2">Iniciar sesión</button></a>
                    <a href="registro"><button type="button" class="btn btn-primary">Registro</button></a>
                    <a href="/logout"><button type="button" class="btn btn-danger">Cerrar sesión</button></a>
                    <!--             Lo que sería el círculo de perfil del usuario -->
                    <!--             <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div> -->
                </div>
                <div class="mt-3">
                    <a href="nuevo-tema"><button type="button" class="btn btn-primary">Crear nuevo tema</button></a>
                </div>
            </div>
    </header>