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

<body>
    <!-- Inicio del container principal -->
    <div class="container-fluid px-4">
        <header class="row d-flex mt-4 mt-md-5 mb-4 pb-4 border-bottom">

            <div class="col-12 d-lg-none d-flex justify-content-center mb-4 p-0">
                <a href="<?= url_to('index') ?>"">
          <img src=" <?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza" width="100%">
                </a>
            </div>



            <div class="col-auto d-none d-lg-block">
                <a href="<?= url_to('index') ?>">
                    <img src="<?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza">
                </a>
            </div>




            <!-- Revisar bootstrap etc -->
            <div class="col-auto p-0 ms-auto">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span><?= auth()->user()->username ?></span>
                    </a>
                    <ul class="dropdown-menu text-small pb-0">
                        <?php if (auth()->user()->can('admin.access')): ?>
                            <li><a class="dropdown-item" href="/panel-de-administracion">Panel de administración</a></li>
                        <?php endif; ?>
                        <?php if (!auth()->user()->can('admin.access')): ?>
                            <li><a class="dropdown-item" href="/admin-access">Obtener admin access</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="/tema">Crear tema</a></li>
                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                        <li><a class="dropdown-item" href="/perfil">Configuración</a></li>
                        <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>

        </header>


        <main class="col-md-9 col-lg-7 order-2 p-3 border rounded ">
            <form action="<?= base_url('admin/crear-categoria') ?>" method="post" class="row needs-validation g-3" novalidate>
                <?= csrf_field() ?>
                <div class="col-12">
                    <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
                </div>
                <div class="col-sm-12 form-group">
                    <label for="category-title" class="form-label">Título *</label>
                    <input
                        id="category-title"
                        name="category-title"
                        type="text"
                        class="form-control"
                        value="<?= esc(set_value('category-title')) ?>"
                        placeholder="Introduce un título para la categoría..."
                        maxlength="100"
                        required>
                    <small class="text-body-secondary">Puede contener 100 caracteres como máximo</small>
                    <div class="invalid-feedback">
                        Introduce un título válido. Asegúrate de cumplir las reglas para el título.
                    </div>
                </div>
                <?php if (isset($errors)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($data)) : ?>
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">
                            <p>Campos data</p>
                            <ul>
                                <?php foreach ($data as $data) : ?>
                                    <li><?= var_dump($data)
                                        ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-sm-12 d-flex ms-auto gap-1">
                    <a href="<?= previous_url() ?>" class="w-100 btn btn-danger btn-lg text-center">Cancelar</a>
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Publicar</button>
                </div>
            </form>
        </main>


        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Admin_dash</title>
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous" />
        </head>

        <body>
            <a href="/"><button class="btn btn-primary mt-5">Volver a ForoCrianza</button></a>
            <div class="row mt-4" style="height: 70vh;">
                <div class="col-2" style="border: 1px solid black;">
                    <div class="">Aside
                        <aside>
                            <main class="d-flex flex-nowrap">
                                <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
                                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                                        <svg class="bi pe-none me-2" width="40" height="32">
                                            <use xlink:href="#bootstrap" />
                                        </svg>
                                        <span class="fs-4">Sidebar</span>
                                    </a>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link active" aria-current="page">
                                                <svg class="bi pe-none me-2" width="16" height="16">
                                                    <use xlink:href="#home" />
                                                </svg>
                                                Meter iconas aquí
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link active" aria-current="page">
                                                <svg class="bi pe-none me-2" width="16" height="16">
                                                    <use xlink:href="#home" />
                                                </svg>
                                                Usuarios
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<? base_url('admin/crear-categoria') ?>" class="nav-link link-body-emphasis">
                                                <svg class="bi pe-none me-2" width="16" height="16">
                                                    <use xlink:href="#speedometer2" />
                                                </svg>
                                                Categorias
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link link-body-emphasis">
                                                <svg class="bi pe-none me-2" width="16" height="16">
                                                    <use xlink:href="#table" />
                                                </svg>
                                                Subcategorias
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link link-body-emphasis">
                                                <svg class="bi pe-none me-2" width="16" height="16">
                                                    <use xlink:href="#grid" />
                                                </svg>
                                                Temas
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link link-body-emphasis">
                                                <svg class="bi pe-none me-2" width="16" height="16">
                                                    <use xlink:href="#people-circle" />
                                                </svg>
                                                Cerrar sesión
                                            </a>
                                        </li>
                                    </ul>
                                    <hr>
                                    <div class="dropdown">
                                        <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                            <strong>username</strong>
                                        </a>
                                        <ul class="dropdown-menu text-small shadow">
                                            <li><a class="dropdown-item" href="#">New project...</a></li>
                                            <li><a class="dropdown-item" href="#">Settings</a></li>
                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </main>
                        </aside>

                    </div>
                </div>
                <div class="col" style="border: 1px solid black;">
                    <div class="row" style="height: 70vh;">
                        <div class="col" style="border: 1px solid black;">
                            <div class="">Donde hacer todo</div>
                        </div>
                        <div class="col-2" style="border: 1px solid black;">
                            <div class="">Margen?</div>
                        </div>
                    </div>
                </div>
            </div>


            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
        </body>

        </html>