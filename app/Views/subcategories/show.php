        <div class="col-md-7 px-1">
            <article class="card mb-4">
                <div class="card-header">
                    <h4>Temas de la subcategoría <?= $title ?></h4>
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-center">
                        <h2 class="">
                            << Paginado>>
                        </h2>
                    </li>
                    <?php if ($subcategory_topics !== []): ?>
                        <?php foreach ($subcategory_topics as $topic): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <a href="<?= current_url() . "/{$topic['slug']}" ?>">
                                    <div class="ms-2 me-auto">
                                        <h5><?= $topic["title"]?></h5>
                                        <?= $topic["author"]?>
                                    </div>
                                </a>
                                <a href="#2">
                                    <div class="ms-2 me-auto">
                                        <h5>Nº mensajes</h5>
                                        Hora último mensaje
                                    </div>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start borde-rojo ">
                            <p style="color: gray">No hay temas disponibles.</p>
                        </li>
                    <?php endif ?>
                    <li class="list-group-item d-flex justify-content-center">
                        <h2 class="">
                            << Paginado>>
                        </h2>
                    </li>
                </ul>
            </article>
        </div>