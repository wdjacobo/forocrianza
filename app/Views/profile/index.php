<main class="col-md-9 col-lg-7 order-2 p-3 border rounded bg-white">
    <h2>Perfil de <?= $user['username'] ?></h2>
    <p>Usando ForoCrianza desde el <?= $user['created_at'] ?>.</p>
    <?php if (count($user_messages) == 0) : ?>
        <p>Parece que <?= $user['username'] ?> todavía no ha publicado ningún mensaje</p>
    <?php else : ?>
        <p>Número de mensajes publicados por <?= $user['username'] ?>: <?= count($user_messages) ?></p>
    <?php endif; ?>
    <?php if ($user_topics !== []) : ?>
        <p>Temas creados por <?= $user['username'] ?>:</p>
        <ul class="">
            <?php foreach ($user_topics as $topic) : ?>
                <li class="list-item"><a href="<?= base_url() . $topic['subcategory_slug'] . "/" .  $topic['topic_slug'] ?>"><?= $topic['title'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Parece que <?= $user['username'] ?> todavía no ha creado ningún tema.</p>
    <?php endif; ?>
</main>