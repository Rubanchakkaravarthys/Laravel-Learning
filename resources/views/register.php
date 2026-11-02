<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h1>Register Form</h1>
<form action="<?=url('/register') ?>" method="post">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
    <label for="name">Name</label><br>
    <input type="text" name="name"><br><br>
     <label for="email">Email</label><br>
    <input type="email" name="email"><br><br>
    <label for="password">Password</label><br>
    <input type="password" name="password"><br><br>
    <label for="password_confirmation">Confirm Password</label><br>
    <input type="password" name="password_confirmation"><br><br>
    <button type="submit">Register</button>
</form>
</body>
</html>
