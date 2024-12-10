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

            <!-- Revisar bootstrap -->
            <div class="col-auto p-0 ms-auto">
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span><?= auth()->user()->username ?></span>
                    </a>
                    <ul class="dropdown-menu text-small pb-0">
                        <li><a class="dropdown-item" href="<?= url_to('index') ?>">Ir a ForoCrianza</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('perfil/' . auth()->user()->username) ?>">Perfil</a></li>
                        <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>

        </header>
        <div class="row">
            <aside class="col-lg-3 col-xl-3 col-xxl-2 d-flex flex-column align-items-stretch flex-shrink-0 mb-3 mb-lg-0">
                <div class="list-group list-group-flush scrollarea border rounded">
                    <a href="<?= url_to('admin-categories') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Categorías' ? 'active' : '' ?>"" aria-current=" true">
                        <div class="d-flex w-100 align-items-center justify-content-between px-1">
                            <strong>Categorías</strong>
                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                                <path d="M120-120v-720h720v720H120Zm60-60h600v-600H180v600Zm0 0v-600 600Z" />
                            </svg>
                        </div>
                    </a>
                    <a href="<?= url_to('admin-subcategories') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Subcategorías' ? 'active' : '' ?>"" aria-current=" true">
                        <div class="d-flex w-100 align-items-center justify-content-between px-1">
                            <strong>Subcategorías</strong>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                                <path d="M120-510v-330h330v330H120Zm0 390v-330h330v330H120Zm390-390v-330h330v330H510Zm0 390v-330h330v330H510ZM180-570h210v-210H180v210Zm390 0h210v-210H570v210Zm0 390h210v-210H570v210Zm-390 0h210v-210H180v210Zm390-390Zm0 180Zm-180 0Zm0-180Z" />
                            </svg>
                            </svg>
                        </div>
                    </a>
                    <a href="<?= url_to('admin-topics') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Temas' ? 'active' : '' ?>"" aria-current=" true">
                        <div class="d-flex w-100 align-items-center justify-content-between px-1">
                            <strong>Temas</strong>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                                <path d="M120-120v-720h720v720H120Zm640-143H200v78h560v-78Zm-560-41h560v-78H200v78Zm0-129h560v-327H200v327Zm0 170v78-78Zm0-41v-78 78Zm0-129v-327 327Zm0 51v-51 51Zm0 119v-41 41Z" />
                            </svg>
                        </div>
                    </a>
                    <a href="<?= url_to('admin-users') ?>" class="list-group-item list-group-item-action border-0 <?php echo $title == 'Usuarios' ? 'active' : '' ?>"" aria-current=" true">
                        <div class="d-flex w-100 align-items-center justify-content-between px-1">
                            <strong>Usuarios</strong>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32px" fill="#e8eaed">
                                <path d="M38-160v-94q0-35 18-63.5t50-42.5q73-32 131.5-46T358-420q62 0 120 14t131 46q32 14 50.5 42.5T678-254v94H38Zm700 0v-94q0-63-32-103.5T622-423q69 8 130 23.5t99 35.5q33 19 52 47t19 63v94H738ZM358-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42Zm360-150q0 66-42 108t-108 42q-11 0-24.5-1.5T519-488q24-25 36.5-61.5T568-631q0-45-12.5-79.5T519-774q11-3 24.5-5t24.5-2q66 0 108 42t42 108ZM98-220h520v-34q0-16-9.5-31T585-306q-72-32-121-43t-106-11q-57 0-106.5 11T130-306q-14 6-23 21t-9 31v34Zm260-321q39 0 64.5-25.5T448-631q0-39-25.5-64.5T358-721q-39 0-64.5 25.5T268-631q0 39 25.5 64.5T358-541Zm0 321Zm0-411Z" />
                            </svg>
                        </div>
                    </a>
                </div>
            </aside>
            <main class="col-lg-9 col-xl-9 col-xxl-10 ">
                <div class="row ">
                    <div class="col-12">
                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger">
                                <?php foreach (session()->get('errors') as $error): ?>
                                    <?= $error ?>
                                <?php endforeach; ?>
                                <?= session('error') ?>
                            </div>
                        <?php elseif (session()->has('error')): ?>
                            <div class="alert alert-danger">
                                <?= session('error') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->has('message')): ?>
                            <?php var_dump("Helooo");
                            exit(); ?>
                            <div class="alert alert-success">
                                <?= session('message') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <form action="<?= base_url('admin/crear-categoria') ?>" method="post" class="col-12 needs-validation g-3" novalidate>
                        <div class="row">
                            <?= csrf_field() ?>
                            <div class="col-12">
                                <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
                            </div>
                            <div class="col-6 form-group ">
                                <label for="category-title" class="form-label"><strong>Título *</strong></label>
                                <input
                                    id="category-title"
                                    name="category-title"
                                    type="text"
                                    class="form-control"
                                    value="<?= esc(set_value('category-title')) ?>"
                                    placeholder="Introduce un título para la categoría..."
                                    maxlength="100"
                                    required>
                                <small class="text-body-secondary">No debe estar vacío y puede contener 100 caracteres como máximo.</small>
                                <div class="invalid-feedback">
                                    Introduce un título con una longitud válida.
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-1 ">
                                <a href="<?= previous_url() ?>" class="w-100 btn btn-danger btn-lg text-center">Cancelar</a>
                                <button class="w-100 btn btn-primary btn-lg" type="submit">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        </main>
    </div>

    <script>
        /**
         * Carga el JS local de Bootstrap si falla la CDN.
         * Crea un nuevo script para el JS de Bootstrap local y mueve los scripts personalizados al final del elemento `<body>` para  evitar errores como los de dependencias de código.
         */
        function loadLocalBootstrapJs() {
            console.warn("No se ha podido cargar el código JS de Bootstrap desde la CDN, se cargará el archivo local.");
            let fallbackScript = document.createElement('script');
            fallbackScript.src = '<?= base_url('js/bootstrap.bundle.min.js') ?>';
            document.body.appendChild(fallbackScript);

            let customScript = document.getElementById('custom-script');
            document.body.appendChild(customScript);
        }
    </script>

    <!-- JS de Bootstrap con fallback -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" onerror="loadLocalBootstrapJs()"></script>

    <!-- JS personalizado -->
    <script id="custom-script" src="<?= base_url('js/forocrianza.js') ?>"></script>

</body>

</html>