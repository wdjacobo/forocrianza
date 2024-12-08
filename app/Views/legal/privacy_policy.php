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
    <link id="custom-styles" rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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
                                <li class="mb-2"><a href="#que-informacion-recopilamos">Qué información recopilamos</a></li>
                                <li class="mb-2"><a href="#como-utilizamos-la-informacion">Cómo utilizamos la información</a></li>
                                <li class="mb-2"><a href="#derechos-y-opciones-como-usuario">Derechos y opciones como usuario</a></li>
                                <li class="mb-2"><a href="#cumplimiento-de-la-normativa-europea">Cumplimiento de la normativa europea</a></li>
                                <li class="mb-2"><a href="#informacion-de-contacto">Informacion de contacto</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="col-12 col-md-9">
                <h1 class="text-center my-4"><?php
                                                if (isset($title)) {
                                                    echo $title;
                                                }
                                                ?></h1>
                <h3 id="que-informacion-recopilamos">Qué información recopilamos</h3>
                <p>Recopilamos la información que usted nos proporciona directamente cuando utiliza nuestros servicios, lo que incluye:</p>
                <h4>Información de su cuenta</h4>
                <p>Si crea una cuenta en ForoCrianza, su cuenta tendrá un nombre de usuario, un correo electrónico y una contraseña asociados, que almacenaremos en nuestros servidores. Cuando usted utiliza nuestros servicios, también puede proporcionar otra información, como una biografía, enlaces a redes sociales, sexo, edad, o ubicación. Esta información es opcional y puede eliminarse en cualquier momento. También almacenamos las preferencias y la configuración de su cuenta de usuario. </p>
                <h4>Contenido no público enviado por usted</h4>
                <p>Esto incluye sus borradores guardados de mensajes o comentarios, sus mensajes con otros usuarios, y sus informes y otras comunicaciones con moderadores y con nosotros. Su contenido puede incluir texto, enlaces, imágenes, gifs, audio o vídeos.</p>
                <h4>Acciones que realiza</h4>
                <p>Esto incluye sus interacciones con la plataforma y el contenido, como votar, guardar, ocultar e informar. También incluye sus interacciones con otros usuarios, como seguir y bloquear. Recopilamos sus interacciones con las comunidades, como sus suscripciones o su condición de moderador. </p>
                <p>También recopilamos automáticamente otra información cuando utiliza nuestros servicios, lo que incluye:</p>
                <h4>Registro y datos de uso</h4>
                <p>Podemos registrar información cuando usted accede a nuestros servicios y los utiliza. Esto puede incluir su dirección IP tipo de navegador, sistema operativo, URL de referencia, información del dispositivo (como ID de dispositivo), configuración del dispositivo, nombre del operador de telefonía móvil, páginas visitadas, enlaces en los que ha hecho clic, la URL solicitada y términos de búsqueda. ForoCrianza eliminará cualquier dirección IP recopilada después de 100 días. </p>


                <h3 id="como-utilizamos-la-informacion">Cómo utilizamos la información</h3>
                <p>Utilizamos la información sobre usted para:</p>
                <ul>
                    <li>Proporcionar, mantener y mejorar los Servicios.</li>
                    <li>Personalizar servicios, contenidos y funciones que se ajusten a sus actividades, preferencias y configuraciones.</li>
                    <li>Ayudar a proteger la seguridad de ForoCrianza y de nuestros usuarios, lo que incluye bloquear a presuntos spammers, abordar el abuso.</li>
                    <li>Investigar y desarrollar nuevos servicios.</li>
                    <li>Supervisar y analizar las tendencias, el uso y las actividades relacionadas con nuestros servicios.</li>
                </ul>
                <h3 id="derechos-y-opciones-como-usuario">Derechos y opciones como usuario</h3>
                <p>Usted tiene opciones sobre cómo proteger y limitar la recopilación, el uso y el intercambio de información sobre usted cuando utiliza ForoCrianza:</p>
                <h4>Acceso y modificación de sus datos</h4>
                <p>Puede acceder a su información y cambiar o corregir determinados datos a través de neustros servicios. También puede solicitar una copia de la información personal que mantenemos sobre usted.</p>
                <h4>Borrar su cuenta</h4>
                <p>Puede eliminar la información de su cuenta en cualquier momento desde la página de preferencias del usuario. Cuando elimine su cuenta, su perfil dejará de ser visible para otros usuarios y se disociará del contenido que haya publicado con esa cuenta. Sin embargo, tenga en cuenta que las publicaciones, comentarios y mensajes que haya enviado antes de eliminar su cuenta seguirán siendo visibles para los demás, a menos que usted elimine primero el contenido específico.</p>
                <h3 id="cumplimiento-de-la-normativa-europea">Cumplimiento de la normativa europea</h3>
                <p class="mb-5">Desde ForoCrianza se garantiza el cumplimiento de la normativa vigente en materia de protección de datos personales, reflejada en la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y de Garantía de Derechos Digitales (LOPD GDD). Cumple también con el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de las personas físicas (RGPD). El uso de sitio Web implica la aceptación de esta Política de Privacidad así como las condiciones incluidas en el Aviso Legal.</p>
                <h3 id="informacion-de-contacto">Informacion de contacto</h3>
                <p>Si le surge cualquier tipo de duda o pregunta sobre nuestra Política de privacidad, puede contactarnos a través de:</p>
                <ul class="mb-5">
                    <li>Correo electrónico: <?= mailto('contacto@forocrianza.com', 'contacto@forocrianza.com'); ?></li>
                </ul>
            </div>
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
         * Carga el CSS local de Bootstrap si falla la CDN.
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
    <script id="custom-script" src="<?= base_url('js/script.js') ?>"></script>

</body>

</html>