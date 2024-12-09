    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Forocrianza es el foro donde compartir y discutir con otros padres y madres experiencias sobre la crianza de nuestros hijos. Este foro contiene información útil para ayudar a las familias en el proceso de crianza de los niños y niñas.">
        <meta name="keywords" content="forocrianza, foro, crianza, foro para padres, foro sobre familia, foro sobre niños, foro sobre educacion, opiniones crianza, opiniones educacion">
        <title>Iniciar sesión | ForoCrianza</title>
        <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/ico">
        <script>
            /**
             * Carga el CSS local de Bootstrap si falla la CDN.
             * Crea un nuevo link para el CSS de Bootstrap local y mueve los estilos personalizados al final del elemento `<head>` para permitir la sobreescritura de estilos de Bootstrap.
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

    <body class="bg-light">
        <main role="main" class="container-md">
            <div class="row d-flex flex-column align-content-center p-sm-5 gap-5">
                <div class="col-12 col-md-8 col-lg-5 d-flex justify-content-center mt-5 mt-sm-1">
                    <a href="<?= url_to('index') ?>">
                        <img src=" <?= base_url('images/brand/isotipo-forocrianza.png') ?>" alt="Isotipo del sitio web ForoCrianza">
                    </a>
                </div>
                <div class="card col-12 col-md-8 col-lg-5 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-5"><strong><?= lang('Auth.login') ?></strong></h5>
                        <!-- Errores -->
                        <?php if (session('error') !== null) : ?>
                            <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                        <?php elseif (session('errors') !== null) : ?>
                            <div class="alert alert-danger" role="alert">
                                <p>Se han detectado los siguientes errores:</p>
                                <?php if (is_array(session('errors'))) : ?>
                                    <ul>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <li><?= $error ?></li>
                                            <br>
                                        <?php endforeach ?>
                                    </ul>
                                <?php else : ?>
                                    <?= session('errors') ?>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                        <?php if (session('warn') !== null) : ?>
                            <div class="alert alert-warning" role="alert"><?= session('warn') ?></div>
                        <?php elseif (session('warns') !== null) : ?>
                            <div class="alert alert-warning" role="alert">
                                <?php if (is_array(session('warns'))) : ?>
                                    <?php foreach (session('warn') as $warn) : ?>
                                        <?= $warn ?>
                                        <br>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <?= session('warns') ?>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                        <?php if (session('message') !== null) : ?>
                            <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                        <?php endif ?>
                        <form action="<?= url_to('login') ?>" method="post" class="needs-validation" novalidate>
                            <?= csrf_field() ?>
                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="EmailInput" class="form-label"><strong><?= lang('Auth.email') ?></strong></label>
                                <input type="email"
                                    class="form-control"
                                    id="EmailInput"
                                    name="email"
                                    placeholder="<?= lang('Auth.email') ?>"
                                    value="usuario@usuario.com"
                                    required>
                                <div class="invalid-feedback">
                                    Debes introducir un email válido.
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="PasswordInput" class="form-label"><strong><?= lang('Auth.password') ?></strong></label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="PasswordInput"
                                    name="password"
                                    placeholder="<?= lang('Auth.password') ?>" value="1234abc." required>
                                <div class="invalid-feedback">
                                    Debes introducir una contraseña.
                                </div>
                            </div>
                            <div class="d-grid col-12 col-md-8 mx-auto m-3">
                                <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.login') ?></button>
                            </div>

                            <?php if (setting('Auth.allowRegistration')) : ?>
                                <p class="text-center"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
                            <?php endif ?>
                            <p class="text-center"><a href="<?= url_to('index') ?>">Volver a la página principal</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </main>

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