<?php
/** @var string $title */
/** @var string $title2 */
/** @var string $test */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Form</title>
</head>

<body>
<h1><?= $title ?></h1>


<?php if (session('message')): ?>
    <p><?= session('message') ?></p>
<?php endif; ?>

<form method="POST" action="<?= url('/getuser-data') ?>">

    <label for="name">Name</label><br>
    <input type="text" name="name" id="name"><br>

    <label for="email">Email</label><br>
    <input type="email" name="email" id="email"><br>

    <button type="submit">Submit</button>

    <input
        type="hidden"
        name="_token"
        value="<?= csrf_token() ?>"
    >

</form>

</body>
</html>
