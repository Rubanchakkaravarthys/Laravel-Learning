<h1>Login</h1>

<?php if ($errors->has('email')): ?>
    <p style="color: red;">
        <?= $errors->first('email') ?>
    </p>
<?php endif; ?>

<form action="<?= url('/login') ?>" method="POST">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>">

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
