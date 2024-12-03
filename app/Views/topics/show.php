        <div class="col-md-7 px-1">

            <article class="card mb-4">
                <div class="card-header">

                    <h4><?= esc($topic_messages[0]['topic_title']) ?></h4>
                    <li class="list-group-item d-flex justify-content-center">
                        <h2 class="">
                            << Paginado>>
                        </h2>
                    </li>
                </div>


                <div class="list-group">
                    <?php //var_dump($topic_messages[0]['topic_author_status_message']); exit(); 
                    ?>
                    <?php if ($topic_messages !== []): ?>
                        <div class="list-group-item topic-author-message">
                            <h5><a href="<?= base_url() . "perfil/" . esc($topic_messages[0]['topic_author_username']) ?>"><?= esc($topic_messages[0]['topic_author_username']) ?></a> (rol especial si tiene)</h5>
                            <p><?php echo !is_null($topic_messages[0]['topic_author_status_message']) ? esc($topic_messages[0]['topic_author_status_message']) : '' ?></p>
                            <p><?= esc($topic_messages[0]['topic_opening_message']) ?></p>
                            <!-- Comprobar el id del autor del mensaje y comparar con el id del autor del tema, si coinciden, poner una clase que le da color distinto al mensaje -->
                        </div>
                    <?php endif ?>

                    <?php if ($topic_messages !== []): ?>
                        <?php foreach ($topic_messages as $message): ?>
                            <div class="list-group-item <?php echo $message['message_author_username'] == $message['topic_author_username'] ? 'topic-author-message' : '' ?>">
                                <h5><a href="<?= base_url() . "perfil/" . esc($message['message_author_username']) ?>"><?= esc($message['message_author_username']) ?></a> (rol especial si tiene)</h5>
                                <p><?php echo !is_null($message['message_author_status_message']) ? esc($message['message_author_status_message']) : '' ?></p>
                                <p><?= esc($message['message_content']) ?></p>
                                <!-- Comprobar el id del autor del mensaje y comparar con el id del autor del tema, si coinciden, poner una clase que le da color distinto al mensaje -->
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