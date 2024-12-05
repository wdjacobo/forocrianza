<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Buttons y alerts</title>
  <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" onerror="loadLocalBootstrapCss()">
</head>


<body>

<article class="my-3" id="buttons">
      <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
        <h3>Buttons</h3>
        <a class="d-flex align-items-center" href="../components/buttons/">Documentation</a>
      </div>

      <div>
        <div class="bd-example-snippet bd-code-snippet">
  <div class="bd-example m-0 border-0">
    
        
        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-secondary">Secondary</button>
        <button type="button" class="btn btn-success">Success</button>
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-warning">Warning</button>
        <button type="button" class="btn btn-info">Info</button>
        <button type="button" class="btn btn-light">Light</button>
        <button type="button" class="btn btn-dark">Dark</button>

        <button type="button" class="btn btn-link">Link</button>
        
  </div>
</div>


        <div class="bd-example-snippet bd-code-snippet">
  <div class="bd-example m-0 border-0">
    
        
        <button type="button" class="btn btn-outline-primary">Primary</button>
        <button type="button" class="btn btn-outline-secondary">Secondary</button>
        <button type="button" class="btn btn-outline-success">Success</button>
        <button type="button" class="btn btn-outline-danger">Danger</button>
        <button type="button" class="btn btn-outline-warning">Warning</button>
        <button type="button" class="btn btn-outline-info">Info</button>
        <button type="button" class="btn btn-outline-light">Light</button>
        <button type="button" class="btn btn-outline-dark">Dark</button>
        
  </div>
</div>


        <div class="bd-example-snippet bd-code-snippet">
  <div class="bd-example m-0 border-0">
    
        <button type="button" class="btn btn-primary btn-sm">Small button</button>
        <button type="button" class="btn btn-primary">Standard button</button>
        <button type="button" class="btn btn-primary btn-lg">Large button</button>
        
  </div>
</div>

      </div>
    </article>

    <article class="my-3" id="alerts">
      <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
        <h3>Alerts</h3>
        <a class="d-flex align-items-center" href="../components/alerts/">Documentation</a>
      </div>

      <div>
        <div class="bd-example-snippet bd-code-snippet">
  <div class="bd-example m-0 border-0">
    
        
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          A simple secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          A simple warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          A simple info alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-light alert-dismissible fade show" role="alert">
          A simple light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
          A simple dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
  </div>
</div>


        <div class="bd-example-snippet bd-code-snippet">
  <div class="bd-example m-0 border-0">
    
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Well done!</h4>
          <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
          <hr>
          <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
        </div>
        
  </div>
</div>

      </div>
    </article>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" onerror="loadLocalBootstrapJs()"></script>
</body>

</html>