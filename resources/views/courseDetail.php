<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Detail</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }

        .course-container {
            width: 400px;
            margin: auto;
            padding: 25px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 10px;
        }

        .student-name {
            margin-bottom: 20px;
            color: #555;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="course-container">

    <h1>Course</h1>

    <p class="student-name">
        Student: <strong><?= htmlspecialchars($student->name) ?></strong>
    </p>

    <form action="<?= url('/course/' . $student->id) ?>" method="POST">

        <input type="hidden" name="_token" value="<?= csrf_token() ?>">

        <label for="course_name">Select Course</label>

        <select name="course_name" id="course_name" required>
            <option value="">-- Select Course --</option>
            <option value="html">HTML</option>
            <option value="css">CSS</option>
            <option value="javascript">JavaScript</option>
            <option value="react">React</option>
            <option value="laravel">Laravel</option>
            <option value="mysql">MySQL</option>
        </select>

        <button type="submit">
            Add Course
        </button>

    </form>

</div>

</body>
</html>
