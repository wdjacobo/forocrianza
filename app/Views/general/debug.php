<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug</title>
</head>

<body>
    <?php if (auth()->loggedIn()): ?>
        <p>Hola usuario con id <?= auth()->id() ?></p>
        <p>Hola <?= auth()->user()->username ?></p>
        <p>Usuario con id <?= user_id() ?></p>
        <?php
        if (! auth()->user()->can('admin.access')) {
            echo "No tienes permiso para acceder como admin";
            //return redirect()->back()->with('error', 'You do not have permissions to access that page.');
        } else {
            echo "Tienes permiso para acceder como admin";
        }
        $user = auth()->user();
        if ($user->inGroup('admin', 'mod')) {
            echo "Eres un admin o un moderador";
        }
        ?>
    <?php else: ?>
        <p>Hola usuario invitado</p>
    <?php endif ?>
    <?php if ($unic !== []): ?>
        <?php var_dump($unic) ?>
    <?php else: ?>
        <h3>No hay categoria única</h3>
    <?php endif ?>
    <?php
    if ($unic_category !== []): ?>
        <?php foreach ($unic_category['subcategories'] as $subcategories): ?>
            <br>
            <?php echo ($subcategories['title']); ?>
            <br>
            <br>
        <?php endforeach ?>
    <?php else: ?>
        <h3>No hay categoria única</h3>
    <?php endif ?>
    <?php if ($categories_list !== []): exit(); ?>
        <?php foreach ($categories_list as $category): ?>
            <br>
            <?php echo ($category['subcategories'][0]['title']); ?>
            <br>
            <br>
        <?php endforeach ?>
    <?php else: ?>
        <h3>No hay categorias</h3>
        <p>No se pudieron encontrar categorías.</p>
    <?php endif ?>
    <?php
    $user = auth()->user();
    var_dump($user);
    die();
    ?>

    <?php
    $user = auth()->user();
    var_dump($user);
    die();
    ?>
    <?= phpinfo();
    die() ?>
</body>

</html>