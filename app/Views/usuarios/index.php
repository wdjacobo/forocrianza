<h2><?= esc($titulo) ?></h2>

<?php if ($lista_usuarios !== []): ?>

    <?php foreach ($lista_usuarios as $usuario): ?>

        <h3><?= esc($usuario['nickname']) ?></h3>

        <div class="main">
            <?= esc($usuario['email']) ?>
        </div>
        <p><a href="/usuarios/<?= esc($usuario['id'], 'url') ?>">Ver usuario</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No hay usuarios</h3>

    <p>No se pudieron encontrar usuarios</p>

<?php endif ?>