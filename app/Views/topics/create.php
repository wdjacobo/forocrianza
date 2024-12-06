<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Topic form</title>
    <link rel="icon" href="<?= base_url() ?>favicon.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" onerror="loadLocalBootstrapCss()">
</head>

<body>

    <?php  ?>
    <div class="container pb-5">
        <form action="<?= base_url() . "crear-tema" ?>" method="post" class="row needs-validation my-5 g-3" novalidate>
            <?= csrf_field() ?>
            <div class="col-12">
                <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
            </div>
            <div class="col-md-6 form-group">
                <label for="category" class="form-label">Categoría *</label>
                <select
                    id="category"
                    name="category"
                    class="form-select"
                    value="<?= old('category') ?>"
                    required>
                    <!-- Si coincide con el esc(old) marcar como selected -->
                    <option value="">Selecciona una categoría...</option>
                    <?php if (isset($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= esc($category['id']) ?>"> <?php
                                                                            if (set_value('subcategory') === $category['id']) {
                                                                                echo "selected";
                                                                            }
                                                                            ?><?= esc($category['title']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una categoría
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="subcategory" class="form-label">Subcategoría *</label>
                <select
                    id="subcategory"
                    name="subcategory"
                    class="form-select"
                    value="<?= old('subcategory') ?>"
                    required>
                    <option value="">Selecciona una subcategoría...</option>
                    <?php if (isset($subcategories)) : ?>
                        <?php foreach ($subcategories as $subcategory) : ?>
                            <option value="<?= esc($subcategory['id']) ?>" <?php
                                                                            if (set_value('subcategory') === $subcategory['id']) {
                                                                                echo "selected";
                                                                            }
                                                                            ?>><?= esc($subcategory['title']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona una subcategoría
                </div>
            </div>
            <div class="col-sm-12 form-group">
                <label for="topic-title" class="form-label">Título *</label>
                <input
                    id="topic-title"
                    name="topic-title"
                    type="text"
                    class="form-control"
                    value="<?= set_value('topic-title') ?>"
                    placeholder="Introduce un título para el tema..."
                    minlength="10"
                    maxlength="250"
                    required>
                <small class="text-body-secondary">Debe contener al menor 10 caracteres</small>
                <div class="invalid-feedback">
                    Introduce un título válido. Asegúrate de cumplir las reglas para el título.
                </div>
            </div>
            <div class="col-sm-12 topic-opening-message">
                <label for="topic-opening-message" class="form-label">Contenido *</label>
                <textarea
                    id="topic-opening-message"
                    name="topic-opening-message"
                    class="form-control"
                    placeholder="Incluir edición con Quill"
                    rows="8"
                    minlength="40"
                    required><?= set_value('topic-opening-message') ?></textarea>
                <small class="text-body-secondary">Debe contener al menor 40 caracteres</small>
                <div class="invalid-feedback">
                    Introduce un contenido válido. Asegúrate de cumplir las reglas para el contenido.
                </div>
            </div>
            <?php if (isset($errors)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($data)) : ?>
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        <p>Campos data</p>
                        <ul>
                            <?php foreach ($data as $data) : ?>
                                <li><?= esc($data) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-3 d-flex ms-auto gap-1">
                <!-- Sobre document:referrer https://developer.mozilla.org/en-US/docs/Web/API/Document/referrer -->
                <!--                 <a href="javascript:window.location.href=document.referrer" class="w-100 btn btn-danger btn-lg text-center">Cancelar</a> -->

                <a href="<?= previous_url() ?>" class="w-100 btn btn-danger btn-lg text-center">Cancelar</a>
                <button class="w-100 btn btn-primary btn-lg" type="submit">Publicar</button>
            </div>
        </form>
    </div>




    <script>
        //Hace quese muestren los errores de invalid o valid feedback
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>


    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

    <div class="p-1 my-5" width="100vw" heigth="20vw" style="background-color: red;">
        <p>Fin</p>
    </div>



    <ul>
        <li>VALIDAR Y AUTOGENERAR</li>
        <li>Category id(select)</li>
        <li>Subcategory id (select)</li>
        <li>Title</li>
        <li>Opening_message</li>
        <li>Slug (autogenerado)</li>
        <li>autogenerados: created_at, updated_at, deleted_at; probar todos los metodos de CI4. Con soft delete y delete normal.</li>
    </ul>

    <article class="my-3" id="disabled-forms">
        <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
            <h3>Disabled forms: usar en modos de edición</h3>
            <a class="d-flex align-items-center" href="../forms/overview/#disabled-forms">Documentation</a>
        </div>

        <div>
            <div class="bd-example-snippet bd-code-snippet">
                <div class="bd-example m-0 border-0">



                    <form>
                        <fieldset disabled aria-label="Disabled fieldset example">
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Disabled input</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                            </div>
                            <div class="mb-3">
                                <label for="disabledSelect" class="form-label">Disabled select menu</label>
                                <select id="disabledSelect" class="form-select">
                                    <option>Disabled select</option>
                                </select>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>

        </div>
    </article>




    <article class="my-3" id="validation">
        <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
            <h3>Validation</h3>
            <a class="d-flex align-items-center" href="../forms/validation/">Documentation</a>
        </div>

        <div>
            <div class="bd-example-snippet bd-code-snippet">
                <div class="bd-example m-0 border-0">

                    <form class="row g-3">
                        <div class="col-md-4">
                            <label for="validationServer01" class="form-label">First name</label>
                            <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationServer02" class="form-label">Last name</label>
                            <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationServerUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                <input type="text" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3" required>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationServer03" class="form-label">City</label>
                            <input type="text" class="form-control is-invalid" id="validationServer03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationServer04" class="form-label">State</label>
                            <select class="form-select is-invalid" id="validationServer04" required>
                                <option selected disabled value="">Choose...</option>
                                <option>...</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationServer05" class="form-label">Zip</label>
                            <input type="text" class="form-control is-invalid" id="validationServer05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
                                <label class="form-check-label" for="invalidCheck3">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </article>
    </section>

    <!-- /* Fin codigo */ -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" onerror="loadLocalBootstrapJs()"></script>
</body>

</html>