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


<body class="bg-primary-lower">
  <!-- Inicio del container principal -->
  <div class="container-lg px-4">
    <header class="row d-flexmt-4 mt-4 mt-md-5 mb-4 pb-4 border-bottom">

      <div class="col-12 d-lg-none d-flex justify-content-center mb-4 p-0">
        <a href="<?= url_to('index') ?>"">
          <img src=" <?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza" width="100%">
        </a>
      </div>


      <div class="col-auto d-block d-lg-none p-0">
        <button
          type="button"
          class="btn btn-outline-primary responsive-btn"
          data-bs-toggle="modal"
          data-bs-target="#aside-modal"
          aria-label="Toggle menu">
          &#9776;
        </button>
      </div>



      <div class="col-auto d-none d-lg-block">
        <a href="<?= url_to('index') ?>">
          <img src="<?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza">
        </a>
      </div>


      <div class="col-4 col-md-5 col-lg-2 col-xl-3 col-xxl-4 d-none d-sm-flex align-items-center p-0 ms-auto">
        <a class="btn btn-outline-primary responsive-btn w-100" href="<?= url_to('create-topic') ?>" type="button" role="button">Crear tema <strong>+</strong></a>
      </div>


      <?php if (auth()->loggedIn()): ?>
        <div class="col-auto d-flex align-items-center p-0 ms-auto">
          <div class="dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="<?= auth()->user()->inGroup('admin') ? 'admin-color' : '' ?>"><?= auth()->user()->username ?></span>
            </a>
            <ul class="dropdown-menu text-small pb-0">
              <?php if (auth()->user()->inGroup('admin')): ?>
                <li><a class="dropdown-item" href="<?= url_to('categories') ?>">Panel de administración</a></li>
              <?php endif; ?>
              <li><a class="dropdown-item" href="<?= base_url('perfil/' . auth()->user()->username) ?>">Perfil</a></li>
              <li class="bg-danger"><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
            </ul>
          </div>
        </div>

      <?php else: ?>

        <div class="col-auto ms-auto d-flex align-items-center gap-1 p-0">
          <a class="btn btn-outline-primary responsive-btn" href="<?= url_to('register') ?>" type="button" role="button">Registrarse</a>
          <a class="btn btn-primary responsive-btn" href="<?= url_to('login')
                                                          ?>" type="button" role="button">Iniciar sesión</a>

        </div>

      <?php endif; ?>

      <div class="col-12 d-block d-sm-none text-center mt-2 p-0">
        <a class="btn btn-outline-primary responsive-btn w-100" href="<?= url_to('create-topic') ?>" type="button" role="button">Crear tema <strong>+</strong></a>
      </div>


    </header>