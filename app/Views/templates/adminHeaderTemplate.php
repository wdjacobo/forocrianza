<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title . ' | ForoCrianza'; ?></title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/ico">
    <script>
        /**
         * Carga el CSS local de Bootstrap si falla la CDN.
         * Crea un nuevo link para el CSS de Bootstrap local y mueve los estilos personalizados al final del elemento `<>` para permitir la sobreescritura de estilos de Bootstrap.
         */
        function loadLocalBootstrapCss() {
            console.warn("No se ha podido cargar el código CSS de Bootstrap desde la CDN, se cargará el archivo local.");
            let fallbackLink = document.createElement('link');
            fallbackLink.rel = 'stylesheet';
            fallbackLink.href = '<?= base_url('css/bootstrap.min.css') ?>';
            document.head.appendChild(fallbackLink);

            let customStyles = document.getElementById('custom-styles');
            document.head.appendChild(customStyles);

        }
    </script>

    <!-- CSS de Bootstrap con fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" onerror="loadLocalBootstrapCss()">

    <!-- CSS personalizado -->
    <link id="custom-styles" rel="stylesheet" href="<?= base_url('css/forocrianza.css') ?>">
</head>

<body class="bg-primary-lower">
    <!-- Inicio del container principal -->
    <div class="container-fluid px-4">
        <header class="row d-flex align-items-center mt-4 mt-md-5 mb-4 pb-4 border-bottom">

            <div class="col-12 d-sm-none d-flex justify-content-center mb-4 p-0">
                <a href="<?= url_to('index') ?>"">
          <img src=" <?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza" width="100%">
                </a>
            </div>

            <div class="col-auto d-none d-sm-block">
                <a href="<?= url_to('index') ?>">
                    <img src="<?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza">
                </a>
            </div>
            <div class="col-auto p-0 ms-auto">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="<?= auth()->user()->inGroup('admin') ? 'admin-color' : '' ?>"><?= auth()->user()->username ?></span>
                    </a>
                    <ul class="dropdown-menu text-small pb-0">
                        <li><a class="dropdown-item" href="<?= url_to('index') ?>">Ir a ForoCrianza</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('perfil/' . auth()->user()->username) ?>">Perfil</a></li>
                        <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>

        </header>