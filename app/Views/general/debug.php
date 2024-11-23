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
    <?php else: ?>
        <p>Hola usuario invitado</p>
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
<?= phpinfo(); die() ?>  
</body>
</html>


