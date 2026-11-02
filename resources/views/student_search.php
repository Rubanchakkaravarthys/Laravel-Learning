<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Filter</title>
</head>
<body>
    <h1>Students Search</h1>
    <form action="<?=url('/student-filter')?>" method="get">
     
<label for="name">Student Name</label> 
 <input type="search" name="student_name">
 <button type="submit">Search</button>

    </form>
</body>
</html>