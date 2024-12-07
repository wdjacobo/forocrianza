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
    <link id="custom-styles" rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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


            <div class="col-auto p-0 ms-auto">
                <a class="btn btn-outline-primary responsive-btn" href="<?= url_to('create-topic') ?>" type="button" role="button">Nuevo tema +</a>
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
            <form action="<?= base_url() . "crear-tema" ?>" method="post" class="row needs-validation g-3" novalidate>
                <?= csrf_field() ?>
                <div class="col-12">
                    <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
                </div>
                <div class="col-md-6 form-group">
                    <label for="category" class="form-label">Categoría *</label>
                    <select
                        id="category"
                        name="category"
                        class="form-select"
                        required>
                        <!-- Si coincide con el esc(old) marcar como selected -->
                        <option value="">Selecciona una categoría...</option>
                        <?php if (isset($categories)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>" <?php
                                                                        if (esc(set_value('category')) === $category['id']) {
                                                                            echo "selected";
                                                                        }
                                                                        ?>><?= $category['title'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, selecciona una categoría
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label for="subcategory" class="form-label">Subcategoría *</label>
                    <select
                        id="subcategory"
                        name="subcategory"
                        class="form-select"
                        data-selected-value="<?= esc(set_value('subcategory')) ?>"
                        required>
                        <option value="">Selecciona una subcategoría...</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, selecciona una subcategoría
                    </div>
                </div>
                <div class="col-sm-12 form-group">
                    <label for="topic-title" class="form-label">Título *</label>
                    <input
                        id="topic-title"
                        name="topic-title"
                        type="text"
                        class="form-control"
                        value="<?= esc(set_value('topic-title')) ?>"
                        placeholder="Introduce un título para el tema..."
                        minlength="10"
                        maxlength="250"
                        required>
                    <small class="text-body-secondary">Debe contener al menor 10 caracteres</small>
                    <div class="invalid-feedback">
                        Introduce un título válido. Asegúrate de cumplir las reglas para el título.
                    </div>
                </div>
                <div class="col-sm-12 topic-opening-message">
                    <label for="topic-opening-message" class="form-label">Contenido *</label>
                    <textarea
                        id="topic-opening-message"
                        name="topic-opening-message"
                        class="form-control"
                        placeholder="Incluir edición con Quill"
                        rows="8"
                        minlength="40"
                        required><?= esc(set_value('topic-opening-message')) ?></textarea>
                    <small class="text-body-secondary">Debe contener al menor 40 caracteres</small>
                    <div class="invalid-feedback">
                        Introduce un contenido válido. Asegúrate de cumplir las reglas para el contenido.
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




        <script>
            //Estilo a las form labels en negrita
            // Pasar a script externo una vez lo tenga listo
            // Código de ejemplo de la documentación de Bootstrap : https://getbootstrap.com/docs/5.3/forms/validation/#custom-styles
            //Hace quese muestren los errores de invalid o valid feedback
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>