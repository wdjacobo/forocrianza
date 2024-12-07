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
  <div class="container-lg px-4">
    <header class="row d-flex mt-4 mt-md-5 mb-4 pb-4 border-bottom">

      <div class="col-12 d-lg-none d-flex justify-content-center mb-4 p-0">
        <a href="<?= url_to('index') ?>"">
          <img src=" <?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza" width="100%">
        </a>
      </div>



      <div class="col-auto d-block d-lg-none p-0">
        <button
          class="btn btn-outline-primary responsive-btn"
          data-bs-toggle="modal"
          data-bs-target="#menuModal"
          aria-label="Toggle menu">
          &#9776;
        </button>
      </div>



      <div class="col-auto d-none d-lg-block">
        <a href="<?= url_to('index') ?>">
          <img src="<?= base_url('images/brand/imagotipo-forocrianza.png') ?>" alt="Imagotipo del sitio web ForoCrianza">
        </a>
      </div>


      <div class="col-auto p-0 ms-auto">
        <a class="btn btn-outline-primary responsive-btn" href="<?= url_to('create-topic') ?>" type="button" role="button">Nuevo tema +</a>
      </div>



      <?php if (auth()->loggedIn()): ?>
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

      <?php else: ?>

        <div class="col-auto ms-auto">
          <a class="btn btn-outline-primary responsive-btn" href="<?= url_to('registro') ?>" type="button" role="button">Registrarse</a>
          <a class="btn btn-primary responsive-btn" href="<?= url_to('iniciar-sesion') //Cambiar por login 
                                                          ?>" type="button" role="button">Iniciar sesión</a>

        </div>

      <?php endif; ?>

    </header>