<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student database</title>
</head>
<body>
<form action="/create" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?=csrf_token() ?>">
    <table>
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="student_name" >
            </td>
              <td>File upload</td>
            <td>
                <input type="file" name="file" >
            </td>
        </tr>
        <table>
        <tr>

            <td>
               <button type="submit">Submit</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
