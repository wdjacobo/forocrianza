<div class="container">
    <div class="row g-5">

        <div class="col-md-3 p-0 pe-3">
        </div>

        <div class="col-md-7 px-1">

            <article class="card mb-4">
                <div class="card-header">
                    <h4>Temas de la subcategoría <?= $subcategory_title ?></h4>
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
                                <a href="#1">
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
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <a href="#1">
                            <div class="ms-2 me-auto">
                                <h5>Titulo tema</h5>
                                Autor y fecha
                            </div>
                        </a>
                        <a href="#2">
                            <div class="ms-2 me-auto">
                                <h5>Nº mensajes</h5>
                                Hora último mensaje
                            </div>
                        </a>
                    </li>

                    <li class="list-group-item d-flex justify-content-center">
                        <h2 class="">
                            << Paginado>>
                        </h2>
                    </li>
                </ul>
            </article>
        </div>

        <div class="col-md-2 p-0 ps-2">
            <div class="position-sticky" style="top: 2rem;">
                <img class="p-4 bg-body-tertiary rounded" style="background-color: gray !important" src="/images/logo/foro.png" alt="" srcset="" width="212" height="600">
            </div>
        </div>
    </div>
    <!-- /EXEMPLO BLOG -->
</div>