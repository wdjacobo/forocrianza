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
            <div class="col-12 card mb-3">
                <div class="card-header d-flex align-content-center bg-primary-fc">
                    <h1 class="card-header-category-title m-0">Lista de usuarios</h1>
                </div>
                <ul class="list-group rounded-0 rounded-bottom">
                    <?php if ($users !== []): ?>
                        <?php foreach ($users as $user): ?>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="m-0 <?= $user['isAdmin'] ? 'admin-color' : '' ?>"><?= $user['username'] ?></h3>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php if ($user['id'] !== user_id()) : ?>
                                            <form action="<?= url_to('delete-user', $user['id']) ?>" method="post" class="d-flex justify-content-end gap-2">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <?= csrf_field() ?>
                                                <?php if ($user['isAdmin']): ?>
                                                    <a href="<?= url_to('remove-admin', $user['id']) ?>" class="btn btn-warning btn-lg">Eliminar de admin</a>
                                                <?php else: ?>
                                                    <a href="<?= url_to('include-admin', $user['id']) ?>" class="btn btn-outline-primary btn-lg">Añadir a admin</a>

                                                <?php endif; ?>
                                                <button class="btn btn-danger btn-lg" type="submit">Eliminar</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class="list-group-item">
                            <p>No hay usuarios disponibles.</p>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</main>
</div>