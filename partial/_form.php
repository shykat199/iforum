<html>

<head>

</head>

<body>

    <?php
    //session_start();
    $update = false;
    $cataid = $_GET['catid'];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        include("../forum/partial/_dbconnect.php");

        //this is used to get it use rid of attacker
        $problemTitle = $_POST['problemTitle'];
        $description = $_POST['description'];

        $problemTitle = str_replace("<", "&lt;", $problemTitle);
        $problemTitle = str_replace(">", "&gt;", $problemTitle);

        $description = str_replace("<", "&lt;", $description);
        $description = str_replace(">", "&gt;", $description);
        //take name from hidden input tag 
        $threads_user_id=$_POST['user_id'];


        $sql = "INSERT INTO `threads` (`threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `timestamp`) 
            VALUES ('$problemTitle','$description','$cataid',  '$threads_user_id', current_timestamp())";

        $result = mysqli_query($con, $sql);

        if ($result) {
            $update = true;
        }
    }


    ?>

    <?php

    if ($update) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert mt-2">
        <strong>Success..!!!!</strong> Your query has been updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    ?>

    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        echo '<div class="jumbotron jumbotron-fluid" style="background-color: hsl(0, 0%, 94%);">
        <div class="container">
            <form class="py-2" action="'.$_SERVER['REQUEST_URI'] .'" method="POST">
                <div class="form-group">
                    <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                    <label for="problemTitle">Problem Title</label>
                    <input type="text" class="form-control" id="problemTitle" name="problemTitle" aria-describedby="problemTitle" placeholder="Enter problem title">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short as possible</small>
                </div>
                <div class="form-group py-2">
                    <label for="exampleInputEmail1">Problem Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
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



</body>

</html>