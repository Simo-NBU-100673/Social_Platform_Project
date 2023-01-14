<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }

    include_once "config.php";
    $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
    $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(empty($message)) {
        exit();
    }

    $sql = mysqli_query($conn, "INSERT INTO messages (sender_id, receiver_id, message)
                                        VALUES ({$sender_id}, {$receiver_id}, '{$message}')");

    //Test if message was inserted
//    $sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE sender_id = {$sender_id} AND receiver_id = {$receiver_id} ORDER BY msg_id DESC LIMIT 1");
//    if(mysqli_num_rows($sql2) > 0) {
//        $row = mysqli_fetch_assoc($sql2);
//
//        //make the output to be json format with sender_id, receiver_id, message
//        echo json_encode($row);
//    }else {
//        echo "Something went wrong";
//    }

