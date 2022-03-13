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
        #cat{
            min-height: 433px;
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
    include('../forum/partial/_slider.php');
    ?>

    <!-- Catagories container starts -->
    <!-- use while loop for iteration to get Catagories from db -->
    <div class="container" >
        <h2 class="text-center my-3">i-Discuss - Catagories</h2>
        <div class="row">
            
            <!-- Fetch all the Catagories -->

            <?php

            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($con, $sql);
            #<!-- use while loop for iteration to get all Catagories from db -->
            while ($row = mysqli_fetch_assoc($result)) {

                $catid = $row['categories_id'];
                $catName = $row['categories_name'];
                $catDescription = $row['categories_description'];
                $descriptionTime = $row['created'];

                echo '<div class="col-md-4 my-2" id="cat">
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/500x400/?coding,'.$catName.'" class="card-img-top" alt="...">
                        <div class="card-body  ">
                            <b><h3 class="card-title"><a href="../forum/threadlist.php?catid='.$catid.'" style="text-decoration:none"> '.$catName.' </a></h3></b>
                            <p class="card-text"><h5>Description</h5></p>
                            <p class="card-text">'.substr( $catDescription,0,151).'</p>
                            <p class="card-text"><b>Time:- </b>'. $descriptionTime.'</b></p>
                            <a href="../forum/threadlist.php?catid='.$catid.'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
    
                </div>';
            }

            ?>
        </div>

    </div>
    <!-- Catagories container fnish -->

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