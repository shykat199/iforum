<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>iDescuss-Coding Forum</title>
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <style>
        #ques {
            min-height: 400px;
        }

        #threadId {
            padding-left: 18px;
        }

        #description {
            padding-left: 18px;
        }

        .jumf {
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <?php
    include('../forum/partial/_dbconnect.php');
    ?>

    <?php
    include('../forum/partial/_header.php');
    ?>


    <?php

    #catid is passed in <a href="../forum/threadlist.php?catid='.$catid.'"
    $catid = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE categories_id =$catid";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catName = $row['categories_name'];
        $catDescription = $row['categories_description'];
        $catDate = $row['created'];

        echo '
                <div class="container my-4">
                    <!-- Jumbotron -->
                    <div class="p-4 shadow-4 rounded-3" style="background-color: hsl(0, 0%, 94%);">
                    <h2 class="display-4">Welcome to ' . $catName . ' forums</h2>
                    <p>
                        ' . $catDescription . '
                    </p><br>
                    Time:-' . $catDate . '

                     <hr class="my-4" />

                    <p>
                         This is a platform to share knowledge with each other.
                    </p>
                    <button type="button" class="btn btn-success">
                        Learn more
                    </button>
                    </div>
                    <!-- Jumbotron -->
                </div>
                ';
    }

    ?>
    <div class="container">
        <h4 class="py-1">Start Discussion</h4>

        <?php

        include("../forum/partial/_form.php");

        ?>
    </div>

    <div class="container my-4" id="ques">

        <h4 class="py-2">Browse Question List</h4>

        <?php

        #catid is passed in <a href="../forum/threadlist.php?catid='.$catid.'"
        $catid = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE threads_cat_id=$catid";
        $result = mysqli_query($con, $sql);
        $get_No_Result = true;
        
        //show all data in webpage from db.
        while ($row = mysqli_fetch_assoc($result)) {
            $get_No_Result = false;
            $threadId = $row['threads_id'];
            $threadTitle = $row['threads_title'];
            $threadDescription = $row['threads_desc'];
            $threadDate = $row['timestamp'];
            $threads_user_id = $row['threads_user_id'];
            $threads_cat_id=$row['threads_cat_id'];

            $sql2 = "SELECT `user_email` FROM users WHERE user_id='$threads_user_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
         
                <div class="media my-3">
                    <div class="media-body">' .
                        '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid=' . $threadId . '">' . $threadTitle . ' </a></h5>
                        ' . $threadDescription . ' </div>' . '<div class="font-weight-bold my-2"> <i class="fa fa-user-circle" aria-hidden="true"></i> Asked by :- ' . $row2['user_email'] . ' at time - ' . $threadDate 
                    . '</div>' .
                '</div>';
        }
        if ($get_No_Result) {
            echo '<div class="jumbotron jumbotron-fluid" style="background-color: hsl(0, 0%, 94%);">
                        <div class="container">
                          <p class="display-5 pl-5 jumf">No question for this topic</p>
                          <p class="lead jumf">Be the first person to ask the question....</p>
                        </div>
                      </div>';
        }

        ?>
    </div>

    <?php
    include('../forum/partial/_footer.php');

    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>