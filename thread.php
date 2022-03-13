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
    <style>
        #ques {
            min-height: 433px;
        }

        .userName {
            color: #FC4922;
        }

        #user {
            color: black;
            text-decoration: none;
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
    #catid is passed in <a href="thread.php?threadid=' . $threadId . '">' . $threadTitle . '</a>
    $threadid = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE threads_id =$threadid";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $threadsTitle = $row['threads_title'];
        $threadsDesc = $row['threads_desc'];
        $timestamp = $row['timestamp'];
        $comment_by = $row['threads_user_id'];

        $sql2 = "SELECT `user_email` FROM users WHERE user_id='$comment_by'";
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $postedBy = $row2['user_email'];

        echo '
                <div class="container my-4">
                    <!-- Jumbotron -->
                    <div class="p-4 shadow-4 rounded-3" style="background-color: hsl(0, 0%, 94%);">
                    <h2 class="display-4">' . $threadsTitle . '</h2>
                    <p class="pt-3">
                      <b>Question:- </b>' . $threadsDesc . '
                    </p><br>
                    Time:-' . $timestamp . '

                     <hr class="my-4" />

                    <p>
                         This is a platform to share knowledge with each other.
                    </p>
                    <p><em>
                    Posted by-' . $postedBy . '
                    </em>
                    </p>
                    </div>
                    <!-- Jumbotron -->
                </div>
                ';
    }

    ?>
    <!--Add comments hear-->
    <div class="container">
        <?php
        $update = false;
        $threadid = $_GET['threadid'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            include("../forum/partial/_dbconnect.php");

            #$problemTitle = $_POST['problemTitle'];
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment); 
            $user_id = $_POST['user_id'];

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `time`, `comment_by`)
             VALUES ('$comment', '$threadid', current_timestamp(), '$user_id')";

            $result = mysqli_query($con, $sql);

            if ($result) {
                $update = true;
            }
        }


        ?>


        <?php

        if ($update) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert mt-2">
        <strong>Success..!!!!</strong> Your Comment has been updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

        ?>
        <h4 class="py-2">Post a comment</h4>
        <?php

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            echo '
                <div class="jumbotron jumbotron-fluid" style="background-color: hsl(0, 0%, 94%);">
            <div class="container">
                <form class="py-2" action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
                    <div class="form-group py-2">
                        <label for="exampleInputEmail1">Type your comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        <input type="hidden" name="user_id" value="' . $_SESSION["user_id"] . '">
                    </div>

                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
            </div>
        </div>';
        } else {
            echo '<div class="jumbotron jumbotron-fluid" style="background-color: hsl(0, 0%, 94%);">
            <div class="container">
            
                <div class="">
                    <p class="pt-2">Please Login first to start discussion.</p>
                    <p>Thank you.</p>
                </div>
                
                <button type="submit" class="btn btn-success mb-2">Login</button>
            
        </div>
    </div>';
        }
        ?>

    </div>

    <!--!!!...End Add comments hear-->


    <!--!!!...Show comments hear from db-->
    <div class="container my-4" id="ques">
        <h4 class="py-2">Discussion</h4>

        <?php
        $threadid = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$threadid";
        $result = mysqli_query($con, $sql);
        $get_No_Result = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $get_No_Result = false;
            $comment_id = $row['comment_id'];
            $comment_content = $row['comment_content'];
            $thread_id = $row['thread_id'];
            $time = $row['time'];
            $comment_by = $row['comment_by'];


            $sql2 = "SELECT `user_email` FROM users WHERE user_id='$comment_by'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
                        <div class="media">
                            <div class="media-body">
                                <p class="font-weight-bold my-0 userName"><i class="fa fa-user-circle" aria-hidden="true"></i> ' . $row2['user_email'] . ' <i id="user">' . $time . '</i></p>                             
                                &nbsp;&nbsp;&nbsp;&nbsp' .  $comment_content . '
                            </div>
                        </div>
                        ';
        }
        if ($get_No_Result) {
                echo '<div class="jumbotron jumbotron-fluid" style="background-color: hsl(0, 0%, 94%);">
                        <div class="container py-2">
                          <p class="display-5 pl-5 jumf">No comment found for this question</p>
                          <p class="lead jumf">Be the first person to ask the question....</p>
                        </div>
                      </div>';
        }

        ?>


    </div>
    <!--!!!...End Show comments hear from db-->


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