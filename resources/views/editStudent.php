<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit students</title>
</head>
<body>
<h1>Edit Students</h1>

<form action="<?= url('/edit/'.$student->id) ?>" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="_token" value="<?= csrf_token() ?>" >
    <table>
        <tr>
            <td>
                <label for="name">Name</label>
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
            <td>   Current File</td>

            <td>

                <?php if ($student->file): ?>

                    <a
                        href="<?= asset('storage/' . $student->file) ?>"
                        target="_blank"
                    >
                        View Current File
                    </a>

                <?php else: ?>

                    No File

                <?php endif; ?>

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

    <td>
      New courses
    </td>

   <tr>
    <td>
        Courses
    </td>

    <td>

        <?php if ($student->courses->isNotEmpty()): ?>

            <?php foreach ($student->courses as $course): ?>

                <div style="margin-bottom: 10px;">

                    <input
                        type="text"
                        name="courses[<?= $course->id ?>]"
                        value="<?= htmlspecialchars($course->course_name) ?>"
                    >

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            No courses found.

        <?php endif; ?>

    </td>
</tr>
</tr>


</tr>


        <tr>

    <td>
        New Address
    </td>

    <td>
        <input
            type="text"
            name="address"
            placeholder="Address"
            value="<?= htmlspecialchars($student->profile?->address ?? '') ?>"
        >
    </td>
</tr>

<tr>
    <td>
        New city
    </td>

    <td>
        <input
            type="text"
            name="city"
            placeholder="City"
            value="<?= htmlspecialchars($student->profile?->city ?? '') ?>"
        >
    </td>
</tr>


        <tr>
            <td></td>

            <td>
                <button type="submit">
                    Update
                </button>
            </td>
        </tr>
    </table>

</form>
</body>
</html>
