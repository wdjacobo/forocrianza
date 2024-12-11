<main class="col-lg-9 col-xl-9 col-xxl-10 ">
    <div class="row" style="height: 70vh;">
        <div class="col">
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
            <div class="col-12 col-lg-5 col-xxl-4 d-sm-flex align-items-center p-0 ms-auto">
                <a class="btn btn-primary responsive-btn w-100 mb-2" href="<?= url_to('create-category') ?>" type="button" role="button">Crear categoría <strong>+</strong></a>
            </div>
            <div class="col-12 card mb-3">
                <div class="card-header d-flex align-content-center bg-primary-fc">
                    <h1 class="card-header-category-title m-0">Lista de categorías</h1>
                </div>
                <ul class="list-group rounded-0 rounded-bottom">
                    <?php if ($categories !== []): ?>
                        <?php foreach ($categories as $category): ?>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="m-0"><?= $category['title'] ?></h3>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <form action="<?= url_to('delete-category', $category['id']) ?>" method="post" class="d-flex justify-content-end gap-2">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <?= csrf_field() ?>

                                            <a href="<?= url_to('edit-category', $category['id']) ?>" class="btn btn-outline-primary btn-lg">Editar</a>
                                            <button class="btn btn-danger btn-lg" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class="list-group-item">
                            <p>No hay categorías disponibles.</p>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</main>
</div>