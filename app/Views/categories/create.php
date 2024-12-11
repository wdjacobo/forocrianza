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
        <form action="<?= base_url('admin/crear-categoria') ?>" method="post" class="col-12 needs-validation g-3" novalidate>
            <div class="row">
                <?= csrf_field() ?>
                <div class="col-12">
                    <p>Los campos marcados con un asterisco (*) son obligatorios.</p>
                </div>
                <div class="col-12 col-xl-6 form-group ">
                    <label for="category-title" class="form-label"><strong>Título *</strong></label>
                    <input
                        id="category-title"
                        name="category-title"
                        type="text"
                        class="form-control"
                        value="<?= esc(set_value('category-title')) ?>"
                        placeholder="Introduce un título para la categoría..."
                        maxlength="100"
                        required>
                    <small class="text-body-secondary">No debe estar vacío y puede contener 100 caracteres como máximo.</small>
                    <div class="invalid-feedback">
                        Introduce un título con una longitud válida.
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