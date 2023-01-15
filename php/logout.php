<?php
    session_start();
    //if no session with unique_id(user logged in) is set, redirect to login page
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }

    if(!isset($_GET['user_id'])){
        header("location: users.php");
    }

    //include DB configuration file
    include_once "config.php";
    
    //This is the user that we want to logout
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $sql = mysqli_query($conn, "UPDATE users SET status = 'Offline now' WHERE unique_id = {$user_id}");

    if($sql){
        session_unset();
        session_destroy();
        header("location: ../login.php");
    }


?>