<?php
session_start();
$user_id = $_SESSION['unique_id'];

include_once "config.php";

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

// This SQL statement selects ALL user except the current user (the one who is logged in)
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$user_id} AND (first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%')");

$output = "";
if(mysqli_num_rows($sql) == 0){
    $output = "No users found with this name";
}elseif(mysqli_num_rows($sql) > 0){
    include "user_data.php";
}

echo $output;