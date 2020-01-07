<?php 
    session_start();
    unset($_SESSION["user_id"]); 
    unset($_SESSION["user_fname"]); 

    // echo "Logged Out";
    // header("Location: http://{$_SERVER['HTTP_HOST']}/index.php");
    header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=logout");
?>