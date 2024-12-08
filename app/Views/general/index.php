        <main class="col-md-9 col-lg-7 order-2 px-1">

            <?php if ($categories_list !== []): ?>
                <?php foreach ($categories_list as $category): ?>
                    <article class="card mb-3">
                        <!-- CAMBIAR FONDO-COLOR -->
                        <div class="card-header d-flex align-content-center fondo-color">
                            <h4 class="card-header-category-title m-0"><?= esc($category['title']) ?></h4>
                        </div>
                        <ul class="list-group">
                            <?php if ($category['subcategories'] !== []): ?>
                                <?php foreach ($category['subcategories'] as $subcategory): ?>
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start borde-azul ">
                                        <div class="ms-2 me-auto">
                                            <h5><a class="text-decoration-none" href="<?=
                                                                                        current_url() . esc($subcategory['slug'], 'url') ?>"><?= esc($subcategory['title']) ?></a></h5>
                                            <p style="color: gray"><?= esc($subcategory['description']) ?></p>
                                        </div>
                                        <div>
                                            <div class="ms-2 me-auto">
                                                <a class="text-decoration-none" href="/perfil"">
                                                <h5>Título último tema</h5>
                                            </a>
                                            <p style=" color: gray">A las [hora] del [fecha]</p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                            <?php else: ?>
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start borde-azul ">
                                    <p style="color: gray">No hay subcategorías disponibles.</p>
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