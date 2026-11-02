<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
</head>

<body>

<h1>Manager Dashboard</h1>

<p>
    Welcome, <?= Auth::user()->name ?>
</p>

<p>
    Role: <?= Auth::user()->role ?>
</p>

<form action="<?= url('/logout') ?>" method="POST">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
    <button type="submit">Logout</button>
</form>

</body>
</html>