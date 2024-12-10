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


<body class="bg-primary-lower legal">
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
        </header



            <div class="container">
        <div class="row g-5">

            <aside class="col-12 col-md-3 p-2">
                <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary position-sticky p-0" style="top: 2rem;">
                    <div class="list-group list-group-flush scrollarea rounded">
                        <div class="list-group-item py-3 lh-sm">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#lssi">Ley de los servicios de la sociedad de la información (LSSI)</a></li>
                                <li class="mb-2"><a href="#datos-identificativos">Datos identificativos</a></li>
                                <li class="mb-2"><a href="#privacidad-y-tratamiento-de-datos">Privacidad y tratamiento de datos</a></li>
                                <li class="mb-2"><a href="#propiedad-industrial-e-intelectual">Propiedad industrial e intelectual</a></li>
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
                <h2 id="lssi">Ley de los servicios de la sociedad de la información (LSSI)</h2>
                <p>ForoCrianza, responsable del sitio web, pone a disposición de los usuarios el presente documento, con el que pretende dar cumplimiento a las obligaciones dispuestas en la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), así como informar a todos los usuarios del sitio web respecto a cuáles son las condiciones de uso.</p>
                <p> Toda persona que acceda a este sitio web asume el papel de usuario, comprometiéndose a la observancia y cumplimiento riguroso de las disposiciones aquí dispuestas, así como a cualquier otra disposición legal que fuera de aplicación.</p>
                <p>ForoCrianza se reserva el derecho de modificar cualquier tipo de información que pudiera aparecer en el sitio web, sin que exista obligación de preavisar o poner en conocimiento de los usuarios dichas obligaciones, entendiéndose como suficiente con la publicación en el sitio web de ForoCrianza</p>
                <h2 id="datos-identificativos">Datos identificativos</h2>
                <ul>
                    <li>Denominación social: ForoCrianza</li>
                    <li>Nombre comercial: ForoCrianza</li>
                    <li>CIF: 011235813F</li>
                    <li>Domicilio: Meconio 5, Madrid.</li>
                    <li>Correo electrónico: <?= mailto('contacto@forocrianza.com', 'contacto@forocrianza.com'); ?></li>
                </ul>
                <h2 id="privacidad-y-tratamiento-de-datos">Privacidad y tratamiento de datos</h2>
                <p>Cuando para el acceso a determinados contenidos o servicio sea necesario facilitar datos de carácter personal, los usuarios garantizarán su veracidad, exactitud, autenticidad y vigencia. La empresa dará a dichos datos el tratamiento automatizado que corresponda en función de su naturaleza o finalidad, en los términos indicados en la sección de <a href="<?= url_to('privacy-policy') ?>">Política de privacidad</a>.</p>
                <h2 id="propiedad-industrial-e-intelectual">Propiedad industrial e intelectual</h2>
                <p class="mb-5">El usuario reconoce y acepta que todos los contenidos que se muestran en el sitio web y en especial, diseños, textos, imágenes, logos, iconos, botones, software, nombres comerciales, marcas, o cualesquiera otros signos susceptibles de utilización industrial y/o comercial están sujetos a derechos de Propiedad Intelectual y todas las marcas, nombres comerciales o signos distintivos, todos los derechos de propiedad industrial e intelectual, sobre los contenidos y/o cualesquiera otros elementos insertados en el página, que son propiedad exclusiva de la empresa y/o de terceros, quienes tienen el derecho exclusivo de utilizarlos en el tráfico económico. Por todo ello el Usuario se compromete a no reproducir, copiar, distribuir, poner a disposición o de cualquier otra forma comunicar públicamente, transformar o modificar tales contenidos manteniendo indemne a la empresa de cualquier reclamación que se derive del incumplimiento de tales obligaciones. En ningún caso el acceso al Espacio Web implica ningún tipo de renuncia, transmisión, licencia o cesión total ni parcial de dichos derechos, salvo que se establezca expresamente lo contrario.</p>
                <h2 id="informacion-de-contacto">Informacion de contacto</h2>
                <p>Si le surge cualquier tipo de duda o pregunta o inquietudes sobre nuestro Aviso legal, puede contactarnos a través de:</p>
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