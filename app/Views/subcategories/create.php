<main class="col-lg-9 col-xl-9 col-xxl-10 ">
    <div class="row ">
        <div class="col-12">
            <h1><?= $title ?></h1>
        </div>
        <div class="col-12">
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('warn')): ?>
                <div class="alert alert-warning">
                    <?= session('warn') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->get('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                    <?= session('error') ?>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
        </div>
        <form action="<?= base_url('admin/crear-subcategoria') ?>" method="post" class="col-12 needs-validation g-3" novalidate>
            <div class="row">
                <?= csrf_field() ?>
                <div class="col-12">
                    <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
                </div>
                <div class="col-12 col-xl-6 form-group">
                    <label for="category" class="form-label">Categoría *</label>
                    <select
                        id="category"
                        name="category"
                        class="form-select"
                        required>
                        <option value="">Selecciona una categoría...</option>
                        <?php if (isset($categories)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>" <?php
                                                                        if (esc(set_value('category')) === $category['id']) {
                                                                            echo "selected";
                                                                        }
                                                                        ?>><?= $category['title'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, selecciona una categoría
                    </div>
                </div>
                <div class="col-12 col-xl-6 form-group ">
                    <label for="subcategory-title" class="form-label"><strong>Título *</strong></label>
                    <input
                        id="subcategory-title"
                        name="subcategory-title"
                        type="text"
                        class="form-control"
                        value="<?= esc(set_value('subcategory-title')) ?>"
                        placeholder="Introduce un título para la subcategoría..."
                        maxlength="100"
                        required>
                    <small class="text-body-secondary">No debe estar vacío, puede contener 100 caracteres como máximo y no puede estar en uso por otra subcategoría.</small>
                    <div class="invalid-feedback">
                        Introduce un título con una longitud válida.
                    </div>
                </div>
                <div class="col-12 col-xl-6 form-group">
                    <label for="subcategory-description" class="form-label"><strong>Descripción *</strong></label>
                    <input
                        id="subcategory-description"
                        name="subcategory-description"
                        type="text"
                        class="form-control"
                        value="<?= esc(set_value('subcategory-description')) ?>"
                        placeholder="Introduce una descripción para la subcategoría..."
                        maxlength="255"
                        required>
                    <small class="text-body-secondary">No debe estar vacía y puede contener 255 caracteres como máximo.</small>
                    <div class="invalid-feedback">
                        Introduce una descripción con una longitud válida.
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center gap-1 mt-4">
                    <a href="<?= previous_url() ?>" class="w-50 btn btn-danger btn-lg text-center">Cancelar</a>
                    <button class="w-50 btn btn-primary btn-lg" type="submit">Crear</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</main>
</div>