<div class="container">
    <!-- EXEMPLO BLOG -->
    <div class="row g-5">

        <aside class="col-md-3 p-0 pe-3">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary borde-gris rounded">

                <div class="list-group list-group-flush border-bottom scrollarea rounded">
                    <div class="list-group-item py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Para ti</strong>

                        </div>
                        <ul style="list-style-type: none;">
                            <li>Tema aleatorio 1</li>
                            <li>Tema aleatorio 2</li>
                            <li>Tema aleatorio 3</li>
                            <li>Tema aleatorio 4</li>
                            <li>Tema aleatorio 5</li>
                        </ul>
                    </div>

                    <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Para ti</strong>

                        </div>
                        <ul style="list-style-type: none;">
                            <li>Tema aleatorio 1</li>
                            <li>Tema aleatorio 2</li>
                            <li>Tema aleatorio 3</li>
                            <li>Tema aleatorio 4</li>
                            <li>Tema aleatorio 5</li>
                        </ul>
                    </a>


                    <a href="#" class="list-group-item list-group-item-action active py-3 lh-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Temas más visitados/con más mensajes (semanales o diarios?)</strong>

                        </div>
                        <ul style="list-style-type: none;">
                            <li>Tema 1</li>
                            <li>Tema 2</li>
                            <li>Tema 3</li>
                            <li>Tema 4</li>
                            <li>Tema 5</li>
                        </ul>
                    </a>


                    <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Últimos temas</strong>
                        </div>
                        <ul style="list-style-type: none;">
                            <li>Tema 1</li>
                            <li>Tema 2</li>
                            <li>Tema 3</li>
                            <li>Tema 4</li>
                            <li>Tema 5</li>
                        </ul>
                    </a>


                    <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Categorías populares (+temas)</strong>
                        </div>
                        <ul style="list-style-type: none;">
                            <li>Categoría 1</li>
                            <li>Categoría 2</li>
                            <li>Categoría 3</li>
                        </ul>
                    </a>


                    <a href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Tema del día (a tal hora del día, coger el tema con más visitas o mensajes?)</strong>
                        </div>
                        <ul style="list-style-type: none;">
                            <li>Tema</li>
                        </ul>
                    </a>
                </div>
            </div>

        </aside>

        <div class="col-md-7 px-1">

            <?php if ($categories_list !== []): ?>
                <?php foreach ($categories_list as $category): ?>
                    <article class="card mb-4">
                        <div class="card-header fondo-color">
                            <h4 class="card-header-category-title borde-rojo"><?= esc($category['title']) ?></h4>
                        </div>
                        <ul class="list-group">
                            <?php if ($category['subcategories'] !== []): ?>
                                <?php foreach ($category['subcategories'] as $subcategory): ?>
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start borde-rojo ">
                                        <div class="ms-2 me-auto">
                                            <h5><a class="text-decoration-none" href="<?= // Se usa iconv() para evitar problemas de caracteres en la URL: https://www.php.net/manual/es/function.iconv.php
                                                                                        base_url() . str_replace(' ', '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $subcategory['title']))); ?>"><?= esc($subcategory['title']) ?></a></h5>
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
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start borde-rojo ">
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
        </div>

        <div class="col-md-2 p-0 ps-2">
            <div class="position-sticky p-0" style="top: 2rem;">
                <img class="p-0 bg-body-tertiary rounded" style="background-color: white !important" src="<?= base_url() ?>/images/ad/ad-1.png" alt="" srcset="">
            </div>
        </div>
    </div>
</div>