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
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
            <div class="card mb-3">
                <div class="card-header d-flex align-content-center bg-primary-fc">
                    <h1 class="card-header-category-title m-0">Lista de usuarios</h1>
                </div>
                <ul class="list-group rounded-0 rounded-bottom">
                    <?php if ($users !== []): ?>
                        <?php foreach ($users as $user): ?>
                            <?php ?>
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto mb-0">
                                    <h3><?= $user['username'] ?></h3>
                                </div>
                                <div>
                                    <div class="ms-2 me-auto">
                                        <form action="<?= url_to('delete-user', $user['id']) ?>" method="post" class="col-sm-12 d-flex ms-auto gap-1">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <?= csrf_field() ?>
                                            <a href="<?= url_to('edit-user', $user['id']) ?>" class="w-100 btn btn-warning btn-lg text-center">Editar</a>
                                            <button class="w-100 btn btn-danger btn-lg text-center" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class=" list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                            <p>No hay usuarios disponibles.</p>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</main>
</div>