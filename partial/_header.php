<?php
session_start();
echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../forum/index.php">i-Fourm</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../forum/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../forum/about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    All Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                    include('_dbconnect.php');
                    $sql="SELECT * FROM `categories`";
                    $result=mysqli_query($con,$sql);
                    while ($row=mysqli_fetch_assoc($result)) {
                        echo'<li>
                                <a class="dropdown-item" href="threadlist.php?catid='.$row['categories_id'].'">'.$row['categories_name'].'</a>
                            </li>';
                    }

        echo'</ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../forum/contact.php">Contact</a>
                </li>
            </ul>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    echo '<form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . '</p>
            </form>
            <div class=" mx-2">
                <a href="partial/_logout.php" class="btn btn-outline-success">Logout</a>
            </div>
        </div>';
} else {
    echo '
    <form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                
            </form>
    <div class=" mx-2">
                
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
}


echo ' </div>
        </div>
    </div>
</nav>
    ';
include('partial/_loginmodal.php');
include('partial/_signupmodal.php');

if (isset($_GET['signupsuccess'])) {
    echo '<script>swal("Success!", "You have successfully signup!", "success");</script>';
}
if (isset($_GET['logoutsuccess'])) {
    echo '<script>swal("Success!", "You have successfully logout!", "success");</script>';
} 
if (isset($_GET['loginsuccess'])) {
    echo '<script>swal("Success!", "You have successfully login!", "success");</script>';
} 
if (isset($_GET['loginError'])) {
    echo '<script>swal("Error!", "Password or Email may not correct!", "error");</script>';
} 
if (isset($_GET['signupsuccessError'])) {
    echo '<script>swal("Error!", "Already have an account!! Try another mail.", "error");</script>';
} 
if (isset($_GET['signupsuccessPassError'])) {
    echo '<script>swal("Error!", "Password and confirm password are not same.", "error");</script>';
} 

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>