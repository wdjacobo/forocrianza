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
                        <li><a class="dropdown-item" href="<?= url_to('index') ?>">Ir a ForoCrianza</a></li>
                        <li><a class="dropdown-item" href="/perfil">Configuración</a></li>
                        <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>

        </header>
        <div class="row mt-4" style="height: 70vh;">
            <div class="col-2" style="border: 1px solid black;">
                <div class="">
                    <aside>
                        <main class="d-flex flex-nowrap">
                            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
                                <ul class="nav nav-pills flex-column mb-auto">
                                    <li class="d-flex nav-item">
                                        <a href="<?= url_to('admin-categories') ?>" class="nav-link <?php echo $title == 'Categorías' ? 'active' : '' ?>" aria-current="page">
                                            Categorías

                                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="16px" fill="#e8eaed">
                                                <path d="M120-120v-720h720v720H120Zm60-60h600v-600H180v600Zm0 0v-600 600Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="d-flex nav-item">
                                        <a href="<?= url_to('admin-subcategories') ?>" class="nav-link <?php echo $title == 'Subcategorías' ? 'active' : '' ?>" aria-current="page">
                                            Subcategorías

                                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="16px" fill="#e8eaed">
                                                <path d="M120-510v-330h330v330H120Zm0 390v-330h330v330H120Zm390-390v-330h330v330H510Zm0 390v-330h330v330H510ZM180-570h210v-210H180v210Zm390 0h210v-210H570v210Zm0 390h210v-210H570v210Zm-390 0h210v-210H180v210Zm390-390Zm0 180Zm-180 0Zm0-180Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="d-flex nav-item">
                                        <a href="<?= url_to('admin-topics') ?>" class="nav-link <?php echo $title == 'Temas' ? 'active' : '' ?>">
                                            Temas

                                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="16px" fill="#e8eaed">
                                                <path d="M120-120v-720h720v720H120Zm640-143H200v78h560v-78Zm-560-41h560v-78H200v78Zm0-129h560v-327H200v327Zm0 170v78-78Zm0-41v-78 78Zm0-129v-327 327Zm0 51v-51 51Zm0 119v-41 41Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="d-flex nav-item">
                                        <a href="<?= url_to('admin-users') ?>" class="nav-link <?php echo $title == 'Usuarios' ? 'active' : '' ?>">
                                            Usuarios

                                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="16px" fill="#e8eaed">
                                                <path d="M38-160v-94q0-35 18-63.5t50-42.5q73-32 131.5-46T358-420q62 0 120 14t131 46q32 14 50.5 42.5T678-254v94H38Zm700 0v-94q0-63-32-103.5T622-423q69 8 130 23.5t99 35.5q33 19 52 47t19 63v94H738ZM358-481q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42Zm360-150q0 66-42 108t-108 42q-11 0-24.5-1.5T519-488q24-25 36.5-61.5T568-631q0-45-12.5-79.5T519-774q11-3 24.5-5t24.5-2q66 0 108 42t42 108ZM98-220h520v-34q0-16-9.5-31T585-306q-72-32-121-43t-106-11q-57 0-106.5 11T130-306q-14 6-23 21t-9 31v34Zm260-321q39 0 64.5-25.5T448-631q0-39-25.5-64.5T358-721q-39 0-64.5 25.5T268-631q0 39 25.5 64.5T358-541Zm0 321Zm0-411Z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                        </main>
                    </aside>

                </div>
            </div>
            <div class="col" style="border: 1px solid black;">
                <div class="row" style="height: 70vh;">
                    <div class="col" style="border: 1px solid black;">
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
                        <div class="">Cargar aquí listado</div>
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