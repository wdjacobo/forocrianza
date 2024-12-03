        <div class="col-md-7 px-1">

            <article class="card mb-4">
                <div class="card-header">
                    <h4>Título del tema</h4>
                    <li class="list-group-item d-flex justify-content-center">
                        <h2 class="">
                            << Paginado>>
                        </h2>
                    </li>
                </div>


                <div class="list-group">
                    <div class="list-group-item borde-rojo">
                        <h5>Username Autor (rol especial si tiene)</h5>
                        <p>Estado</p>
                        <p>Este es el mensaje de apertura</p>
                        <p>Este mensaje, y quizás todos los del autor del tema, estarán resaltados de algún modo</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro quis error corporis nesciunt dolorum reiciendis ex ducimus aspernatur quidem officiis? Ipsa consequuntur atque eum, facere quibusdam voluptatum. Ut corrupti recusandae cupiditate odit, animi, iusto neque ullam hic explicabo nostrum tempore!</p>
                    </div>


                    <?php if ($topic_messages !== []): ?>
                        <?php foreach ($topic_messages as $message): ?>
                            <div class="list-group-item">
                                <h5><a href="<?= base_url() . "perfil/" . esc($message['author_id'])?>"><?= esc($message['author_username']) ?></a> (rol especial si tiene)</h5>
                                <p><?php echo !is_null($message['author_status']) ? esc($message['author_status']) : '' ?></p>
                                <p><?= esc($message['content']) ?></p>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <p style="color: gray">No hay mensajes para este tema.</p>
                    <?php endif ?>
                    <li class="list-group-item d-flex justify-content-center">
                        <h2 class="">
                            << Paginado>>
                        </h2>
                    </li>

                </div>
            </article>
        </div>