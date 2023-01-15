<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }

    include_once "config.php";
    $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
    $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);

    $sql = mysqli_query($conn, "SELECT * FROM messages
                                LEFT JOIN users ON users.unique_id = messages.sender_id
                                WHERE (sender_id = {$sender_id} AND receiver_id = {$receiver_id})
                                OR (sender_id = {$receiver_id} AND receiver_id = {$sender_id})
                                ORDER BY msg_id");

//If table were connected must happend with query:
//$sql = mysqli_query($conn, "SELECT * FROM messages
//                                LEFT JOIN users ON users.unique_id = messages.sender_id
//                                WHERE (sender_id = {$sender_id} AND receiver_id = {$receiver_id})
//                                OR (sender_id = {$receiver_id} AND receiver_id = {$sender_id})
//                                ORDER BY msg_id");

    if(mysqli_num_rows($sql) > 0) {
        $output = "";

        while($row = mysqli_fetch_assoc($sql)) {
            if($row['sender_id'] == $sender_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                            </div>';
            }else {
                $output .= '<div class="chat incoming">
                                <img src="php/images/'. $row['img'] .'" alt="">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                            </div>';
            }
        }
        echo $output;
    }

    //             SENDER
//              <div class="chat outgoing">
//                <div class="details">
//                    <p>This is a message</p>
//                </div>
//            </div>

//             RECEIVER
//            <div class="chat incoming">
//                <img src="images/no-profile-picture-icon.svg" alt="">
//                <div class="details">
//                    <p>This is another message</p>
//                </div>
//            </div>

?>