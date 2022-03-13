<?php 
 $showAlert=false;
  if (isset($_POST['login'])) {
    include('../forum/partial/_dbconnect.php');

    $loginEmail=$_POST['loginEmail'];
    $loginPass=$_POST['loginPass'];

    $sql = "SELECT * from users where user_email='$loginEmail'";
    $result=mysqli_query($con,$sql);
    $numRow=mysqli_num_rows($result);
    if ($numRow==1) {
        $row=mysqli_fetch_assoc($result);
        if (password_verify($loginPass,$row['user_pass'])) {
            $showAlert = true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$loginEmail;
            $_SESSION['user_id']=$row['user_id'];
            
            echo"Loggin in ".$loginEmail;
             //header("LOCATION: index.php?loginsuccess=true");
             //exit();
        }
          header("LOCATION: index.php?loginsuccess=true");
          
               
    }else{
      header("LOCATION: index.php?invalid=true");
      exit();
    }
    

  }else{
    echo"not working";
  }
  
?>