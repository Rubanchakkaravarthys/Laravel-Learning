<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>sorting</title>

<style>
     .sort{
     display: flex;
     gap:4px;
     
    }

    .sort a {
    text-decoration: none;
    border:1px solid #000;
    background: #000;
    color:white;
    padding:10px 15px;
    border-radius:10px;
}
</style>
</head>
<body>
    <h1>student Sorting</h1>
<div class="sort"  >
       <a href="<?=url('/sort?sort=asc')?>">Asc</a>
       <a href="<?=url('/sort?sort=desc')?>">Desc</a>
</div>
</body>
</html>



