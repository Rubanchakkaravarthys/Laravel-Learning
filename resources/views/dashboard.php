<?php

use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>

<body>

<h1>Dashboard</h1>

<p>
    Welcome, <?=Auth::user()->name ?>
</p>

<p>
    Email: <?= Auth::user()->email ?>
</p>

<form action="/logout" method="POST">

   <input type="hidden" name="_token" value="<?= csrf_token() ?>">

    <button type="submit">
        Logout
    </button>

</form>

</body>
</html>
