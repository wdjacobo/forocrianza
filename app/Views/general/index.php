        <div class="col-md-7 px-1 mb-3">

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