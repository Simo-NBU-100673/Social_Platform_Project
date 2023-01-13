<?php
    //start session
    session_start();

    //get connection to database from config.php
    include_once 'config.php';

    //get the data from the request
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    # check if all variables are not null
    if (empty($email) || empty($password)) {
        echo "All input fields are required!";
        exit();
    }

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
    if(mysqli_num_rows($sql) <= 0){
        echo "Error: password or email is incorrect";
        exit();
    }

    $row = mysqli_fetch_assoc($sql);
    $_SESSION['unique_id'] = $row['unique_id'];
    echo "success";
?>
