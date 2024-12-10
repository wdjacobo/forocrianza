<main class="col-lg-9 col-xl-9 col-xxl-10 ">
    <div class="row" style="height: 70vh;">
        <div class="col">
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <div class="col-4 col-md-5 col-lg-2 col-xl-3 col-xxl-4 d-none d-sm-flex align-items-center p-0 ms-auto">
                <a class="btn btn-primary responsive-btn w-100 mb-2" href="<?= url_to('create-category') ?>" type="button" role="button">Crear categoría <strong>+</strong></a>
            </div>

            <div class="card mb-3">
                <div class="card-header d-flex align-content-center bg-primary-fc">
                    <h1 class="card-header-category-title m-0">Lista de categorías</h1>
                </div>
                <ul class="list-group rounded-0 rounded-bottom">
                    <?php if ($categories !== []): ?>
                        <?php foreach ($categories as $category): ?>
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto mb-0">
                                    <h3><?= $category['title'] ?></h3>
                                </div>
                                <div>
                                    <div class="ms-2 me-auto">
                                        <form action="<?= base_url('admin/eliminar-categoria/') . $category['id'] ?>" method="post" class="col-sm-12 d-flex ms-auto gap-1">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <?= csrf_field() ?>

                                            <a href="<?= url_to('edit-category', $category['id']) ?>" class="w-100 btn btn-warning btn-lg text-center">Editar</a>

                                            <button class="w-100 btn btn-danger btn-lg text-center" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class=" list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <p>No hay categorías disponibles.</p>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</main>
</div>