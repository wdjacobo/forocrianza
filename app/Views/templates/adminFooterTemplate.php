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