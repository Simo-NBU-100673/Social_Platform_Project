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
     while ($row = mysqli_fetch_assoc($sql)) {
         $output .= "<a href='chat.php?user_id={$row['unique_id']}'>
         <div class='content'>
           <img src='php/images/{$row['img']}' alt=''>
           <div class='details'>
             <span>{$row['first_name']} {$row['last_name']}</span>
             <p>{$row['status']}</p>
           </div>
         </div>
         <div class='status-dot'><i class='fas fa-circle'></i></div>
       </a>";
     }
 }

 echo $output;
