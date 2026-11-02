<!DOCTYPE html>
<html>
<head>
    <title>Students</title>

  <style>
     table {
        margin:20px 0px;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 8px;
    }
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

   .pagination {
            margin-top: 25px;
        }


        .pagination a,
        .pagination strong,
        .pagination span {
            display: inline-block;

            padding: 8px 12px;

            margin-right: 5px;

            border: 1px solid #000;

            text-decoration: none;

            border-radius: 4px;
        }


        .pagination a {
            color: black;
            background: white;
        }


        .pagination a:hover {
            background: #eeeeee;
        }


        .pagination strong {
            background: black;
            color: white;
        }


        .pagination span {
            color: #999;
            border-color: #ccc;
        }


        .back {
            display: inline-block;

            margin-top: 20px;

            padding: 8px 15px;

            background: black;

            color: white;

            text-decoration: none;

            border-radius: 5px;
        }
        input{
            height: 36px;
            border-radius: 5px;
            border:1px solid black;
            outline: none;


        }:focus{
           outline: none;


        }

  </style>
</head>

<body>

<h1>Students</h1>

<div class="sort">

 <form action="<?= url('/student-view') ?>" method="GET">

        <input
            type="search"
            name="search"
            class="search-input"
            placeholder="Search student by name..."
            value="<?= htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >


            <a href="<?=url('/sort?sort=asc')?>">Asc</a>
       <a href="<?=url('/sort?sort=desc')?>">Desc</a>
        <a href="<?= url('/student-view') ?>" class="btn btn-reset">
            Reset
        </a>

    </form>

</div>


<table>

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>File</th>
        <th>course</th>
        <!-- <th>Subject</th> -->
        <th>Address</th>
        <th>City</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($students as $student): ?>

    <tr>
        <td><?= $student->id ?></td>

        <td><?= $student->name ?></td>
        <td>
            <?php if($student->file): ?>
                    <a
                        href="<?= asset('storage/' . $student->file) ?>"
                        target="_blank"
                    >
                        View File
                    </a>

                <?php else: ?>

                    No File


        <?php endif; ?>



                </td>

     <td>

    <?php if ($student->courses->isNotEmpty()): ?>

        <?php foreach ($student->courses as $course): ?>

            <div>
                <?= htmlspecialchars($course->course_name) ?>
            </div>

        <?php endforeach; ?>

    <?php else: ?>

        No Course

    <?php endif; ?>

</td>


                <td>
    <?php if ($student->profile): ?>

        <?= $student->profile->address ?>

    <?php else: ?>

        No Profile

    <?php endif; ?>
</td>

<td>
    <?php if ($student->profile): ?>

        <?= $student->profile->city ?>

    <?php else: ?>

        No Profile

    <?php endif; ?>
</td>



        <td>
            <a href="<?= url('/edit/' . $student->id) ?>">
                Edit
            </a>
        </td>

        <td>
            <a href="<?= url('/delete/' . $student->id) ?>">
                Delete
            </a>
        </td>
    </tr>

    <?php endforeach; ?>

</table>

<!-- pagination -->

<div class="pagination">

    <!-- Previous -->

    <?php if ($students->onFirstPage()): ?>

        <span> Previous </span>

    <?php else: ?>

        <a href="<?= $students->previousPageUrl() ?>" >  Previous </a>

    <?php endif; ?>


    <!-- Page Numbers -->

    <?php for ( $page = 1; $page <= $students->lastPage(); $page++ ): ?>


        <?php if ($page == $students->currentPage() ): ?>

            <strong> <?= $page ?> </strong>

        <?php else: ?>

            <a href="<?= $students->url($page) ?>" > <?= $page ?> </a>

        <?php endif; ?>


    <?php endfor; ?>


    <!-- Next -->

    <?php if ($students->hasMorePages()): ?>

        <a  href="<?= $students->nextPageUrl() ?>" > Next </a>

    <?php else: ?>

        <span> Next </span>

    <?php endif; ?>


</div>

<a href="<?= url('/student-pagination') ?>" class="back" >Back</a>

</div>

</body>
</html>
