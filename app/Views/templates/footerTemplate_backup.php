<footer style="background-color: #efefef;">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 mt-5 border-top" style="background-color: #efefef;">
        <div class="col mb-3">
            <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                <img src="<?= base_url()?>/images/logo/foro.png" alt="" srcset="" width="80" height="80">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>
            <p class="text-body-secondary">&copy; 2024</p>
        </div>

        <div class="col mb-3">

        </div>

        <div class="col mb-3">
            <h5>Links burocráticos</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Aviso Legal</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de cookies</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de privacidad</a></li>
            </ul>
        </div>

        <div class="col mb-3">
            <h5>Section</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
            </ul>
        </div>
    </div>
    </div>
</footer>


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
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

-->

<script src="<?= base_url() ?>/js/script.js"></script>

</body>

</html>