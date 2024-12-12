<main class="col-md-9 col-lg-7 order-2 px-1">
    <article class="card mb-4">
        <div class="card-header">
            <h4><?= $title ?></h4>
            <h2>Temas</h2>
        </div>
        <ul class="list-group">
            <?php if ($subcategory_topics !== []): ?>
                <?php foreach ($subcategory_topics as $topic): ?>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <div class="me-auto mb-0">
                            <h3><a href="<?= current_url() . "/{$topic['slug']}" ?>"><?= $topic["title"] ?></a></h3>
                            <p class="mb-0"><?= $topic["author"] ?></p>
                        </div>
                        <div>
                            <div class="d-none d-lg-flex flex-column align-items-end ms-2 me-auto borde-rojo">

                                <?php if (true) : ?>
                                    <span>Nº mensajes</span>
                                    <span>Hora último mensaje</span>
                                <?php else: ?>
                                    <span>Sin temas</span>
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