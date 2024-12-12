<main class="col-md-9 col-lg-7 order-2 px-1">
    <article class="card mb-4 bg-transparent">
        <div class="card-header bg-transparent">
            <h4><?= esc($topic['title']) ?></h4>
        </div>
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->get('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif (session()->has('error')): ?>
            <div class="alert alert-danger">
                <ul>
                    <li> <?= session('error') ?></li>
                </ul>
            </div>
        <?php endif; ?>
        <div class="list-group">
            <div class="list-group-item bg-author">
                <p><?= $topic['created_at'] ?></p>
                <h5><a href="<?= base_url() . "perfil/" . esc($topic['author_username']) ?>"><?= $topic['author_username'] ?></a></h5>
                <p><?= $topic['opening_message'] ?></p>
                <?php if (user_id() == $topic['author_id']) : ?>
                    <form action="<?= base_url('eliminar-tema/') . $topic['id'] ?>" method="post" class="col-sm-12 d-flex ms-auto gap-1">
                        <input type="hidden" name="_method" value="DELETE">
                        <?= csrf_field() ?>
                        <button class="btn btn-danger btn-sm text-center" type="submit">Eliminar tema</button>
                    </form>
                <?php endif ?>
            </div>
            <?php if ($messages !== []) : ?>
                <?php foreach ($messages as $message) : ?>
                    <div class="list-group-item <?= ($topic['author_id'] === $message['author_id']) ? 'bg-author' : '' ?>">
                        <p><?= $message['created_at'] ?></p>
                        <h5><a href="<?= base_url('perfil/') . $message['author_username'] ?>"><?= $message['author_username'] ?></a></h5>
                        <p><?= $message['content'] ?></p>
                        <?php if (user_id() == $message['author_id']) : ?>

                            <form action="<?= base_url('eliminar-mensaje/') . $message['id'] ?>" method="post" class="col-sm-12 d-flex ms-auto gap-1">
                                <input type="hidden" name="_method" value="DELETE">
                                <?= csrf_field() ?>
                                <button class="btn btn-danger btn-sm text-center" type="submit">Eliminar mensaje</button>
                            </form>

                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (auth()->loggedIn()) : ?>
                <form action="<?= base_url('crear-mensaje/') . $topic['id'] ?>" method="post" class="needs-validation g-3 p-2 pb-4 mt-2" novalidate>
                    <?= csrf_field() ?>
                    <div class="col-12">
                        <textarea
                            id="message"
                            name="message"
                            class="form-control"
                            placeholder="Escribe una respuesta..."
                            rows="8"
                            minlength="10"
                            required><?= esc(set_value('message')) ?></textarea>
                        <small class="text-body-secondary">Debe contener al menor 10 caracteres</small>
                        <div class="invalid-feedback">
                            El contenido de tu mensaje es demasiado corto.
                        </div>
                    </div>
                    <div class="col-sm-12 d-flex mt-3">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Publicar</button>
                    </div>
                </form>
            <?php else : ?>
                <div class="p-2 pb-4 mt-2">
                    <div class="col-sm-12 d-flex justify-content-center mt-3">
                        <a class="w-75 btn btn-primary btn-lg responsive-btn" href="<?= url_to('login')
                                                                                    ?>" type="button" role="button">Inicia sesión para publicar una respuesta</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </article>
</main>