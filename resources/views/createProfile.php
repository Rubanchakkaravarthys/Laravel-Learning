<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create profile</title>
</head>
<body>
<h1>Create Profile</h1>


<form action="<?= url('/profile-create/'.$student->id) ?>" method="post">
    <input type="hidden" name="_token" value="<?= @csrf_token() ?>">
       <input
        type="text"
        name="address"
        placeholder="Address"
    >
<br>
    <input
        type="text"
        name="city"
        placeholder="City"
    >
    <br>

    <button type="submit">
        Save Profile
    </button>
</form>
</body>
</html>
