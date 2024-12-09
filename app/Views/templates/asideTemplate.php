    <div class="row d-flex justify-content-center">
        <aside class="col-md-3 order-1 p-0 pe-1 d-none d-lg-block">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary borde-gris rounded">
                <div class="list-group list-group-flush border-bottom scrollarea rounded">
                    <?php if ($last_topics !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <h4 class="mb-2">Últimos temas</h4>
                                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="48px" fill="#699cc9" class="mb-3">
                                    <path d="M360-860v-60h240v60H360Zm90 447h60v-230h-60v230Zm30 332q-74 0-139.5-28.5T226-187q-49-49-77.5-114.5T120-441q0-74 28.5-139.5T226-695q49-49 114.5-77.5T480-801q67 0 126 22.5T711-716l51-51 42 42-51 51q36 40 61.5 97T840-441q0 74-28.5 139.5T734-187q-49 49-114.5 77.5T480-81Zm0-60q125 0 212.5-87.5T780-441q0-125-87.5-212.5T480-741q-125 0-212.5 87.5T180-441q0 125 87.5 212.5T480-141Zm0-299Z" />
                                </svg>
                            </div>
                            <ul class="list-unstyled">
                                <?php foreach ($last_topics as $topic): ?>
                                    <li class="mb-2"><a href="<?= base_url() . $topic['subcategory_slug'] . "/" .  $topic['topic_slug'] ?>"><?= character_limiter($topic['title'], 34) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <?php if ($topics_with_most_messages !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <h4 class="mb-2">Temas más comentados</h4> <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#699cc9" class="mb-3">
                                    <path d="M220-400q0 63 28.5 118.5T328-189q-4-12-6-24.5t-2-24.5q0-32 12-60t35-51l113-111 113 111q23 23 35 51t12 60q0 12-2 24.5t-6 24.5q51-37 79.5-92.5T740-400q0-54-23-105.5T651-600q-21 15-44 23.5t-46 8.5q-61 0-101-41.5T420-714v-20q-46 33-83 73t-63 83.5q-26 43.5-40 89T220-400Zm260 24-71 70q-14 14-21.5 31t-7.5 37q0 41 29 69.5t71 28.5q42 0 71-28.5t29-69.5q0-20-7.5-37T551-306l-71-70Zm0-464v132q0 34 23.5 57t57.5 23q18 0 33.5-7.5T622-658l18-22q74 42 117 117t43 163q0 134-93 227T480-80q-134 0-227-93t-93-227q0-128 86-246.5T480-840Z" />
                                </svg>
                            </div>
                            <ul class="list-unstyled">
                                <?php foreach ($topics_with_most_messages as $topic): ?>
                                    <li class="mb-2"><a href="<?= base_url() . $topic['subcategory_slug'] . "/" .  $topic['topic_slug'] ?>"><?= character_limiter($topic['title'], 34) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <?php if ($trending_subcategories !== []): ?>
                        <div href="#" class="list-group-item py-3 lh-sm">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <h4 class="mb-2">Subcategorías populares</h4>
                                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#699cc9" class="mb-3">
                                    <path d="m668-380 172-148 85 7-189 162 57 246-74-45-51-222Zm-93-289-57-134 32-77 92 217-67-6ZM263-245l157-94 157 95-42-178 138-120-182-16-71-168-71 167-182 16 138 120-42 178Zm-90 125 65-281L20-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-345Z" />
                                </svg>
                            </div>
                            <ul class="list-unstyled">
                                <?php foreach ($trending_subcategories as $subcategory): ?>
                                    <li class="mb-2"><a href="<?= base_url() . $subcategory['slug'] ?>"><?= character_limiter($subcategory['title'], 34) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <!-- Apartados del aside por implementar -->
                    <?php
                    /*
                    <div href="#" class="list-group-item py-3 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Explorar</strong>
                        </div>
                        <form class="" role="search">
                            <input class="form-control me-2" placeholder="Buscar temas..." type="search" aria-label="Search">
                            <input class="btn btn-outline-primary responsive-btn" type="submit" value="Buscar temas">
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

*/
                    ?>
                </div>
            </div>

        </aside>