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
                                <h1 class="card-header-category-title m-0">Lista de temas</h1>
                            </div>
                            <ul class="list-group rounded-0 rounded-bottom">
                                <?php if ($topics !== []): ?>
                                    <?php foreach ($topics as $topic): ?>
                                        <li class="list-group-item list-group-item-action">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <h3 class="m-0"><?= $topic['title'] ?></h3>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <form action="<?= url_to('delete-topic', $topic['id']) ?>" method="post" class="d-flex justify-content-end gap-2">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <?= csrf_field() ?>
                                                        <a href="<?= url_to('edit-topic', $topic['id']) ?>" class="btn btn-outline-primary btn-lg">Editar</a>
                                                        <button class="btn btn-danger btn-lg" type="submit">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <li class="list-group-item">
                                        <p>No hay temas disponibles.</p>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
            </div>