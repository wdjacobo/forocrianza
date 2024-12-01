<footer class="bg-light py-3 mt-5 border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="aviso-legal" class="nav-link">Aviso Legal</a>
                    </li>
                    <li class="nav-item">
                        <a href="politica-de-cookies" class="nav-link">Política de cookies</a>
                    </li>
                    <li class="nav-item">
                        <a href="politica-de-privacidad" class="nav-link">Política de privacidad</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Para usar fallback:
 
<script src="/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" 
        crossorigin="anonymous"
        onerror="fallbackBootstrapjs()">
</script>
<script>
    function fallbackBootstrapjs() {
        console.error('CDN de Bootstrap JS no cargó. Usando recurso local.');
        const script = document.createElement('script');
        script.src = '/js/bootstrap.min.js'; // Ruta del archivo local
        document.body.appendChild(script);
    }
</script>-->
<!--  En caso de querer usar Popper.js

Be sure to include popper.min.js before Bootstrap’s JavaScript or use bootstrap.bundle.min.js / bootstrap.bundle.js which contains Popper.js. Popper.js isn’t used to position dropdowns in navbars though as dynamic positioning isn’t required.
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

-->

<!-- JS personalizado -->
<script src="<?= base_url() ?>/js/script.js"></script>

</body>

</html>