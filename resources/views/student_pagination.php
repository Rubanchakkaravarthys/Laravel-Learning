<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pagination</title>
    <style>
        p{
              font-family: 'Open Sans', sans-serif;
        }
        a{
            text-decoration:none;
            border:1px solid #ccc;
            background:#ccc;
            color:black;
            padding:15px;
            border-radius:10px ;
           font-weight: 300;
           font-family: 'Open Sans', sans-serif;
          
        }
        .link{
            margin-top:50px;
        }
    </style>
</head>
<body>
    
    <h1>Student Pagination</h1>

    <p>
            Manage and view the list of students using pagination.
            Click the button below to view all students.
        </p>

   <div class="link">
     <a href="<?=url("/pagination")?>">view students</a>
   </div>
   
</body>
</html>