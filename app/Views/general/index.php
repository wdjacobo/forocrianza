        <main class="col-md-9 col-lg-7 order-2 px-1">
            <?php if ($categories_list !== []): ?>
                <?php foreach ($categories_list as $category): ?>
                    <article class="card mb-3">
                        <div class="card-header d-flex align-content-center bg-primary-fc">
                            <h2 class="card-header-category-title m-0"><?= esc($category['title']) ?></h2>
                        </div>
                        <ul class="list-group rounded-0 rounded-bottom">
                            <?php if ($category['subcategories'] !== []): ?>
                                <?php foreach ($category['subcategories'] as $subcategory): ?>
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                        <div class="me-auto mb-0">
                                            <h3><a href="<?=
                                                            current_url() . esc($subcategory['slug'], 'url') ?>"><?= esc($subcategory['title']) ?></a></h3>
                                            <p class="mb-0"><?= esc($subcategory['description']) ?></p>
                                        </div>
                                        <div>
                                            <div class="d-none d-lg-flex flex-column align-items-end ms-2 me-auto borde-rojo">

                                                <?php if (isset($subcategory['last_topic'])) : ?>
                                                    <a href="<?= base_url() . $subcategory['slug'] . '/' . $subcategory['last_topic']['slug'] ?>"><?= character_limiter($subcategory['last_topic']['title'], 28) ?></a>
                                                    <p><?= $subcategory['last_topic']['created_at'] ?></p>
                                                <?php else: ?>
                                                    <p>Sin temas</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                            <?php else: ?>
                                <li class=" list-group-item list-group-item-action d-flex justify-content-between align-items-start">

                                    <!-- Ahora mismo esto nunca sucede porque la consulta a la BBDD devuelve únicamente aquellas categorías que tienen alguna subcategoría -->
                                    <p>No hay subcategorías disponibles.</p>
                                </li>
                            <?php endif ?>
                        </ul>
                    </article>
                <?php endforeach ?>
            <?php else: ?>
                <h3>No hay categorias</h3>
                <p>No se pudieron encontrar categorías.</p>
            <?php endif ?>
        </main>