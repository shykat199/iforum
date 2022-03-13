<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDescuss-Coding Forum</title>
    <style>
        #maincontainer {
            min-height: 488px;
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

   

    <!--Search Result start-->
    <div class="container my-3" id="maincontainer">
        <div class="resultsearch">
            <h1>Search result for <em>"<?php

                                    echo  $_GET['search'];

                                    ?>"</em> </h1>
        </div>


<?php 
        $noresult=true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM threads WHERE MATCH(threads_title,threads_desc) against('$query')"; 
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult=false;
            $threadsTitle = $row['threads_title'];
            $threadsDesc = $row['threads_desc'];
            $threads_id = $row['threads_id'];

             echo'<div class="result"><a href="thread.php?threadid='.$threads_id.'" class="text-dark">
                    <h3>'.$threadsTitle.'</a></h3>
                    <p>'.$threadsDesc.'</p>

                </div>';
            
        }

        if ($noresult) {
            echo'<div class="jumbotron jumbotron-fluid py-2" style="background-color: hsl(0, 0%, 94%);">
            <div class="container">
            
                <div class="">
                <p>No results containing all your search terms were found.</p>

               <p> Your search <b>- '.$_GET['search'].' -</b> did not match.</p>
                
                <p>Suggestions:<ul>
                
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li>
                    <li>Try fewer keywords.</li>
                </ul>
                </p>
                </div>            
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