<main class="col-md-9 col-lg-7 order-2 px-1">
    <article class="card mb-4">
        <div class="card-header bg-primary-fc">
            <h4>Temas de <?= $title ?></h4>
        </div>
        <ul class="list-group rounded-0 rounded-bottom">
            <?php if ($subcategory_topics !== []): ?>
                <?php foreach ($subcategory_topics as $topic): ?>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <div class="me-auto mb-0">
                            <h3><a href="<?= current_url() . "/{$topic['slug']}" ?>"><?= $topic["title"] ?></a></h3>
                            <a href="<?= base_url('perfil/') . $topic['author'] ?>" class="mb-0"><?= $topic["author"] ?></a>
                        </div>
                        <div>
                            <div class="d-none d-lg-flex flex-column align-items-end ms-2 me-auto" style="min-width:240px;">
                                    <span class="">Respuestas: <?= $topic['message_count']?></span>
                                    <?php if ($topic['message_count'] != 0) : ?>
                                    <span>Última el <?= $topic['last_message_date']?></span>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            <?php else: ?>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start borde-rojo ">
                    <p style="color: gray">No hay temas disponibles.</p>
                </li>
            <?php endif ?>
        </ul>
    </article>
</main>