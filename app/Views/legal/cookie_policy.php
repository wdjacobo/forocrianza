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


<body>
    <!-- Inicio del container principal -->
    <div class="container-lg px-4">
        <header class="row d-flexmt-4 mt-4 mt-md-5 mb-4 pb-4 border-bottom">

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

            <?php if (auth()->loggedIn()): ?>
                <div class="col-auto d-flex align-items-center p-0 ms-auto">
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span><?= auth()->user()->username ?></span>
                        </a>
                        <ul class="dropdown-menu text-small pb-0">
                            <li><a class="dropdown-item" href="<?= base_url('perfil/' . auth()->user()->username) ?>">Configuración</a></li>
                            <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </header>

        <div class="row g-5">

            <aside class="col-12 col-md-3 p-0">
                <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary position-sticky p-0" style="top: 2rem;">
                    <div class="list-group list-group-flush scrollarea rounded">
                        <div class="list-group-item py-3 lh-sm">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#que-son-las-cookies">¿Qué son las cookies?</a></li>
                                <li class="mb-2"><a href="#que-tipo-de-cookies-utilizamos">¿Qué tipo de cookies utilizamos?</a></li>
                                <li class="mb-2"><a href="#como-puedo-gestionar-las-cookies">¿Cómo puede gestionar las cookies?</a></li>
                                <li class="mb-2"><a href="#cambios-en-la-politica-de-cookies">Cambios en la política de cookies</a></li>
                                <li class="mb-2"><a href="#informacion-de-contacto">Informacion de contacto</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>




            <div class="col-12 col-md-9">
                <h1 class="text-center my-4"><?php
                                                if (isset($title)) {
                                                    echo esc($title);
                                                }
                                                ?></h1>
                <h3 id="que-son-las-cookies">¿Qué son las cookies?</h3>
                <p>Las cookies son procedimientos automáticos de recogida de información relativa a las preferencias determinadas por el usuario durante su visita al sitio Web con el fin de reconocerlo como usuario, y personalizar su experiencia y el uso del sitio Web, y pueden también, por ejemplo, ayudar a identificar y resolver errores.</p>
                <h3 id="que-tipo-de-cookies-utilizamos">¿Qué tipo de cookies utilizamos?</h3>
                <h4>Cookies propias</h4>
                <p>En ForoCrianza, utilizamos cookies de sesión. Estas cookies son temporales y se eliminan automáticamente una vez que cierra su navegador. La finalidad de estas cookies es gestionar su sesión en el foro y asegurarse de que puede navegar entre las distintas páginas de manera fluida sin tener que iniciar sesión continuamente. </p>
                <h4>Cookies de terceros</h4>
                <p>Son cookies utilizadas y gestionadas por entidades externas que proporcionan a ForoCrianza servicios solicitados por este mismo para mejorar el sitio web y la experiencia del usuario al navegar en el sitio web.</p>
                <p>Puede obtener más información sobre las cookies de terceros empleadas en ForoCrianza, como información sobre la privacidad, descripción del tipo de cookies que se utiliza, sus principales características o periodo de expiración en los siguientes enlaces:</p>
                <ul>
                    <li><?= auto_link("Google Analytics: https://developers.google.com/analytics") ?></li>
                </ul>
                <h3 id="como-puedo-gestionar-las-cookies">¿Cómo puede gestionar las cookies?</h3>
                <p>Puede configurar su navegador para aceptar o rechazar todas las cookies, o bien para que le avise cada vez que se envíe una cookie. Si no acepta las cookies, algunas funciones del sitio web podrían no funcionar correctamente, como la funcionalidad de inicio de sesión.Para gestionar las cookies, siga las instrucciones de su navegador:
                </p>
                <ul>
                    <li><?= auto_link("Google Chrome: https://support.google.com/chrome/answer/95647?hl=es") ?></li>
                    <li><?= auto_link("Mozilla Firefox: https://support.mozilla.org/es/kb/Borrar%20cookies") ?></li>
                    <li><?= auto_link("Microsoft Edge: https://support.microsoft.com/es-es/windows/administrar-cookies-en-microsoft-edge-ver-permitir-bloquear-eliminar-y-usar-168dab11-0753-043d-7c16-ede5947fc64d") ?></li>
                    <li><?= auto_link("Safari: https://support.apple.com/es-es/guide/safari/sfri11471/mac") ?></li>
                </ul>
                <h3 id="cambios-en-la-politica-de-cookies">Cambios en la política de cookies</h3>
                <p class="mb-5">Podemos actualizar esta Política de Cookies para reflejar cambios en nuestra práctica o en la legislación vigente. Cuando realicemos modificaciones, se actualizará la fecha de la última revisión en la parte superior de este documento. Le recomendamos revisar esta página periódicamente para estar informado sobre cómo protegemos su privacidad al usar cookies.</p>
                <h3 id="informacion-de-contacto">Informacion de contacto</h3>
                <p>Si le surge cualquier tipo de duda o pregunta sobre nuestra Política de cookies, puede contactarnos a través de:</p>
                <ul class="mb-5">
                    <li>Correo electrónico: <?= mailto('contacto@forocrianza.com', 'contacto@forocrianza.com'); ?></li>
                </ul>
            </div>
        </div>


        <!-- Fin del container principal -->
    </div>

    <footer class="container-fluid bg-light py-5 py-md-3 mt-5 border-top">
        <div class="row d-flex justify-content-center">
            <div class="col-12 text-center mt-md-3 mb-md-4 mb-3">
                <img src=" <?= base_url('images/brand/isotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza">
            </div>
            <nav class="col-auto">
                <ul class="nav d-flex flex-column flex-md-row text-center">
                    <li class="nav-item m-2">
                        <a href="<?= url_to('legal-notice') ?>">Aviso legal</a>
                    </li>
                    <li class="nav-item m-2">
                        <a href="<?= url_to('cookies-policy'); ?>">Política de cookies</a>
                    </li>
                    <li class="nav-item m-2">
                        <a href="<?= url_to('privacy-policy') ?>">Política de privacidad</a>
                    </li>
                </ul>
            </nav>
        </div>
    </footer>

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