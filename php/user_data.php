<?php
     if(!isset($_SESSION['unique_id'])){
         header("location: login.php");
     }
    
     $current_user_id = $_SESSION['unique_id'];

    while ($row = mysqli_fetch_assoc($sql)) {
      //gets all messages between the current user and the user in the loop
      $sql2 = "SELECT * FROM messages
                      WHERE (sender_id = {$row['unique_id']} 
                      AND receiver_id = {$current_user_id})
                      OR (sender_id = {$current_user_id} 
                      AND receiver_id = {$row['unique_id']})
                      ORDER BY msg_id DESC LIMIT 1";
      
      $query2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($query2);

      //gets the last massage between the current user
      //and the user in the loop if there is one
      $last_message = "No message available";
      if(mysqli_num_rows($query2) > 0){
        $last_message = $row2['message'];
      }

      //if the last message was from the current user then we add You: to the start
      if(isset($row2['sender_id']) && $row2['sender_id'] == $current_user_id){
        $last_message = "You: " . $last_message;
      }

      //if the last message is longer than 28 characters then we cut it
      if(strlen($last_message) > 28){
        $last_message = mb_substr($last_message, 0, 28) . "...";
      }

      //if the user is online then we make the dot green
      $status = "";
      if($row['status'] != "Active now"){
        $status = "offline";
      }

      //we see if the folder with images there is an image with the name of the image in the
      //database by the coresponding user and if there is not any image in the specific folder
      //with that name we send the no image path to the image wich indicates that there is
      //not an uploaded image for this user
      $no_image_path = "images/no-profile-picture-icon.svg";
      $image_path = "php/images/" . $row['img'];
      if(!file_exists("images/" . $row['img'])){
        $image_path = $no_image_path;
      }

        $output .= "<a href='chat.php?user_id={$row['unique_id']}'>
             <div class='content'>
               <img src='{$image_path}' alt=''>
               <div class='details'>
                 <span>{$row['first_name']} {$row['last_name']}</span>
                 <p>$last_message</p>
               </div>
             </div>
             <div class='status-dot $status'><i class='fas fa-circle'></i></div>
           </a>";
    }
?>
