<?php 
    session_start();
    echo "Logging you out. Please wait...";
    session_destroy();
    //header("LOCATION: index.php");
     echo '<script type="text/javascript">';
    echo 'window.location.href="../index.php?logoutsuccess=true"';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=../index.php?logoutsuccess=true" />';
    echo '</noscript>';
    exit();