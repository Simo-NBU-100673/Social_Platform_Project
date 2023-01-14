<?php
 session_start();
 $outgoing_id = $_SESSION['unique_id'];

 include_once "config.php";
// This SQL statement selects ALL user except the current user (the one who is logged in)
 $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");

 $output = "";

 if(mysqli_num_rows($sql) == 0){
     $output = "No users are available to chat with";
 }elseif(mysqli_num_rows($sql) > 0){
    include "user_data.php";
 }

 echo $output;
