<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>

<body>

<form action="<?= url('/edit/' . $student->id) ?>" method="post" enctype="multipart/form-data" >

    <input
        type="hidden"
        name="_token"
        value="<?= csrf_token() ?>"
    >

    <table>
        <tr>
            <td>
                <label for="student_name">Name</label>
            </td>

            <td>
                <input
                    type="text"
                    id="student_name"
                    name="student_name"
                    value="<?= htmlspecialchars($student->name) ?>"
                >
            </td>
        </tr>

        <tr>
            <td>Current File</td>
            <td>
                <?php if($student->file) :?>
                    <a href="<?= asset('storage/'.$student->file) ?> ">
                        View Current File
                    </a>
                <?php else: ?>
                    <span>No File</span>
                <?php endif;?>
            </td>
        </tr>
          <tr>
            <td>
                New File
            </td>

            <td>
                <input
                    type="file"
                    name="file"
                >
            </td>
        </tr>

        <tr>
<td></td>

            <td>
                <button type="submit">Update</button>
            </td>
        </tr>
    </table>

</form>

</body>
</html>
