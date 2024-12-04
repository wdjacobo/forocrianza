<div class="container">
    <!-- EXEMPLO BLOG -->
    <div class="row g-5">

        <aside class="col-md-3 p-0 pe-3">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary borde-gris rounded">

                <div class="list-group list-group-flush border-bottom scrollarea rounded">

                    <div href="#" class="list-group-item py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Explorar</strong>
                        </div>
                        <form class="" role="search">
                            <input class="form-control me-2" placeholder="Buscar temas..." type="search" aria-label="Search">
                            <input class="btn btn-primary" type="submit" value="Buscar temas">
                        </form>
                    </div>
                    <?php if (auth()->loggedIn()): ?>
                        <?php if ($trending_subcategories !== []): ?>
                            <div href="#" class="list-group-item py-3 lh-sm">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">Para ti</strong>
                                </div>
                                <ul style="list-style-type: none;">
                                    <?php foreach ($trending_subcategories as $trending_subcategory): ?>
                                        <li><a href="<?= base_url() . $trending_subcategory['slug'] ?>">Tema para la sesión</a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <?php if ($trending_subcategories !== []): ?>

                    <?php endif ?>
                    <?php if ($trending_subcategories !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Tema del día (a tal hora del día, coger el tema con más visitas o mensajes?)</strong>
                            </div>
                            <ul style="list-style-type: none;">
                                <?php foreach ($trending_subcategories as $trending_subcategory): ?>
                                    <li><a href="<?= base_url() . $trending_subcategory['slug'] ?>"><?= esc($trending_subcategory['title']) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <?php if ($trending_subcategories !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Últimos temas</strong>
                            </div>
                            <ul style="list-style-type: none;">
                                <?php foreach ($trending_subcategories as $trending_subcategory): ?>
                                    <li><a href="<?= base_url() . $trending_subcategory['slug'] ?>"><?= esc($trending_subcategory['title']) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <?php if ($trending_subcategories !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Temas más visitados</strong>
                            </div>
                            <ul style="list-style-type: none;">
                                <?php foreach ($trending_subcategories as $trending_subcategory): ?>
                                    <li><a href="<?= base_url() . $trending_subcategory['slug'] ?>"><?= esc($trending_subcategory['title']) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <?php if ($trending_subcategories !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Categorías populares</strong>
                            </div>
                            <ul style="list-style-type: none;">
                                <?php foreach ($trending_subcategories as $trending_subcategory): ?>
                                    <li><a href="<?= base_url() . $trending_subcategory['slug'] ?>"><?= esc($trending_subcategory['title']) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
            </div>

        </aside>