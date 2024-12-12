<main class="col-md-9 col-lg-7 order-2 px-1">
    <article class="card mb-4 bg-transparent">
        <div class="card-header bg-transparent">
            <h4><?= esc($topic['title']) ?></h4>
        </div>
        <div class="list-group">
            <div class="list-group-item bg-author">
                <h5><a href="<?= base_url() . "perfil/" . esc($topic['author_username']) ?>"><?= $topic['author_username'] ?></a></h5>
                <p><?= $topic['opening_message'] ?></p>
                <?php if (user_id() == $topic['author_id']) : ?>
                    <a href="<?= previous_url() ?>" class="btn btn-danger btn-lg text-center">Eliminar tema</a>
                <?php else: ?>
                    <p>Id del autor<?= esc($topic['author_id']) ?></p>
                    <p>Tu id: <?= esc(user_id()) ?></p>
                <?php endif ?>
            </div>
            <div class="list-group-item rounded-bottom">
                <h5><a href="#">Autor de una respuesta</a></h5>
                <p>Respuesta, si coincide el id, poner clase bg-author</p>
                <a href="<?= previous_url() ?>" class="btn btn-danger btn-lg text-center">Eliminar mensaje</a>
            </div>
            <form action="<?= base_url('crear-mensaje') ?>" method="post" class="list-group-itemneeds-validation g-3 p-2 pb-4 mt-2" novalidate>
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
                        Introduce un contenido válido. Asegúrate de cumplir las reglas para el contenido.
                    </div>
                </div>
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                        <ul>
                            <?php foreach (session()->get('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif (session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <p>Se han detectado errores en el formulario enviado. Asegúrate de cumplir con lo siguiente:</p>
                        <ul>
                            <li> <?= session('error') ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="col-sm-12 d-flex mt-3">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Publicar</button>
                </div>
            </form>
        </div>
    </article>
</main>