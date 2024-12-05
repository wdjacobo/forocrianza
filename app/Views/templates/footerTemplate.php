<!-- Fin del container principal -->
</div>

<footer class="container-fluid bg-light py-5 py-md-3 mt-5 border-top">
    <div class="row d-flex justify-content-center">
        <div class="col-12 text-center mt-md-3 mb-md-4 mb-3">
            <img src=" <?= base_url() ?>images/brand/isotipo-forocrianza.png" alt="Imagotipo del sitio web ForoCrianza">
        </div>
        <nav class="col-auto">
            <ul class="nav d-flex flex-column flex-md-row text-center">
                <li class="nav-item m-2">
                    <a href="<?= url_to('legal-notice') ?>">Aviso legal</a>
                </li>
                <li class="nav-item m-2">
                    <a href="<?= url_to('cookies-policy') ?>">Política de cookies</a>
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
        fallbackScript.src = '<?= base_url() ?>/js/bootstrap.bundle.min.js';
        document.body.appendChild(fallbackScript);

        let customScript = document.getElementById('custom-script');
        document.body.appendChild(customScript);
    }
</script>

<!-- JS de Bootstrap con fallback -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" onerror="loadLocalBootstrapJs()"></script>

<!-- JS personalizado -->
<script id="custom-script" src="<?= base_url() ?>js/script.js"></script>

</body>

</html>