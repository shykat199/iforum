<?php

$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '_dbconnect.php';
  if (isset($_POST['email']) || isset($_POST['email']) || isset($_POST['email'])) {
    $user_email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cPassword'];

    // Check whether this email exists
    $existSql = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($con, $existSql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
      //$showError = "Email already in use";
      echo "<script>window.location.href='index.php?signupsuccessError=false'</script>";
      //exit();

    } else {
      if ($pass == $cpass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamo`) VALUES ( '$user_email', '$hash', current_timestamp())";
        $result = mysqli_query($con, $sql);
        //echo $result;
        if ($result) {

          $showAlert = true;
          //Redirect to index.php file without header()....
          //echo "<script>window.location.href='yourPage.php'</script>";
          echo '<script type="text/javascript">';
          echo 'window.location.href="index.php?signupsuccess=true"';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=/forum/index.php?signupsuccess=true" />';
          echo '</noscript>';
          exit;
        }

      } else {
        //$showError = "Passwords do not match";
        echo "<script>window.location.href='index.php?signupsuccessPassError=true'</script>";
        exit();
      }
    }
    //header('Location: ../index.php?signupsuccess=false&error='$showError);
     echo "<script>window.location.href='index.php?signupsuccess=true'</script>";
    exit(); 
  }
}
?>
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupmodalLabel">Sign Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">

          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="mb-3">
            <label for="cPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cPassword" name="cPassword">
          </div>
          <button type="submit" class="btn btn-primary">Signup</button>
        </form>
      </div>

    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>