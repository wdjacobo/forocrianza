<footer class="bg-light py-3 mt-5 border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="<?= $legal_info['notice']['link'] ?>" class="m-2"><?= $legal_info['notice']['text'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $legal_info['cookies']['link'] ?>"><?= $legal_info['cookies']['text'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $legal_info['privacy']['link'] ?>" class="m-2"><?= $legal_info['privacy']['text'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    /**
     * Loads local Bootstrap JS if CDN load fails.
     * Creates a new script for local Bootstrap JS and moves custom scripts to the end of body element to avoid script dependencies errors.
     */
    function loadLocalBootstrapJs() {
        console.warn("No se ha podido cargar el JS de Bootstrap desde la CDN, se cargará el archivo local.");
        let fallbackScript = document.createElement('script');
        fallbackScript.src = '<?= base_url() ?>/js/bootstrap.bundle.min.js';
        document.body.appendChild(fallbackScript);

        let customScript = document.getElementById('customScript');
        document.body.appendChild(customScript);
    }
</script>

<!-- JS de Bootstrap con fallback -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" onerror="loadLocalBootstrapJs()"></script>

<!-- JS personalizado -->
<script src="<?= base_url() ?>js/script.js" id="customScript"></script>

</body>

</html>