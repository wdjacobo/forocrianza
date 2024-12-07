<main class="col-md-9 col-lg-7 order-2 px-1">
    <article class="card mb-4">
        <div class="card-header">
            <h4>Temas de la subcategoría <?= $title ?></h4>
        </div>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-center">
                <div class="bd-example-snippet bd-code-snippet">
                    <div class="bd-example m-0 border-0">
                        <nav aria-label="Standard pagination example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Primera">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Anterior">
                                        <span aria-hidden="true">&lsaquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Siguiente">
                                        <span aria-hidden="true"> &rsaquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Última">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </li>
            <?php if ($subcategory_topics !== []): ?>
                <?php foreach ($subcategory_topics as $topic): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <a href="<?= current_url() . "/{$topic['slug']}" ?>">
                            <div class="ms-2 me-auto">
                                <h5><?= $topic["title"] ?></h5>
                                <?= $topic["author"] ?>
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
                <div class="bd-example-snippet bd-code-snippet">
                    <div class="bd-example m-0 border-0">

                        <nav aria-label="Standard pagination example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Primera">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Anterior">
                                        <span aria-hidden="true">&lsaquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Siguiente">
                                        <span aria-hidden="true"> &rsaquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Última">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </li>
        </ul>
    </article>
</main>