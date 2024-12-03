<div class="container">
    <!-- EXEMPLO BLOG -->
    <div class="row g-5">

        <aside class="col-md-3 p-0 pe-3">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary borde-gris rounded">

                <div class="list-group list-group-flush border-bottom scrollarea rounded">

                    <?php if (auth()->loggedIn()): ?>
                        <div class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Para ti</strong>

                            </div>
                            <ul style="list-style-type: none;">
                                <li>Tema por sesion 1</li>
                                <li>Tema por sesion 2</li>
                                <li>Tema por sesion 3</li>
                                <li>Tema por sesion 4</li>
                                <li>Tema por sesion 5</li>
                            </ul>
                        </div>
                    <?php endif ?>




                    <div href="#" class="list-group-item py-3 lh-sm" aria-current="true">
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
                    </div>


                    <div href="#" class="list-group-item py-3 lh-sm">
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
                    </div>




                    <?php if ($trending_subcategories !== []): ?>

                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <strong class="mb-1">Categorías populares (+temas)</strong>
                            </div>
                            <ul style="list-style-type: none;">
                                <?php foreach ($trending_subcategories as $trending_subcategory): ?>
                                    <li><a href="<?= base_url() . $trending_subcategory['slug'] ?>"><?= esc($trending_subcategory['title'])?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>








                    <div href="#" class="list-group-item py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Tema del día (a tal hora del día, coger el tema con más visitas o mensajes?)</strong>
                        </div>
                        <ul style="list-style-type: none;">
                            <li>Tema</li>
                        </ul>
                    </div>
                </div>
            </div>

        </aside>