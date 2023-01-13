<?php
    //start session
    session_start();

    //get connection to database from config.php
    include_once 'config.php';

    //get the data from the request
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    # check if all variables are not null
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email_address']) || empty($_POST['password'])) {
        echo "All input fields are required!";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(strlen($email) > 5){
            $errEmail = substr($email, 0, 5);
            echo "$errEmail.. is NOT a valid email";
        }else{
            echo "$email is NOT a valid email";
        }
        exit();
    }

    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        echo "$email - This email already exists!";
        exit();
    }

    if (strlen($password) <= 5) {
        echo "Password must be greater than 5 characters";
        exit();
    }

    if (strlen($password) >= 255) {
        echo "Password must be less than 255 characters";
        exit();
    }

    if (!isset($_FILES['image'])) {
        echo "Please select an image file!";
        exit();
    }

    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);

    $extensions = ['png', 'jpeg', 'jpg'];
    if (!in_array($img_ext, $extensions)) {
        echo "Please select an image file - jpeg, png, jpg\n Extension: .$img_ext is not supported";
        exit();
    }

    $time = time();
    $new_img_name = $time . $img_name;
    if (!move_uploaded_file($tmp_name, "images/".$new_img_name)) {
        echo "Image upload not successful";
        exit();
    }

    $status = "Active now";
    $random_id = rand(time(), 10000000);

    $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, first_name, last_name, email, password, img, status) 
    VALUES ({$random_id}, '{$first_name}', '{$last_name}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

    if (!$sql2) {
        echo "Error in database insertion of user data";
        exit();
    }

    $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql3) <= 0) {
        echo "Account still not created\n Email: $email is not found";
        exit();
    }

    $row = mysqli_fetch_assoc($sql3);
    $_SESSION['unique_id'] = $row['unique_id'];
    echo "success";


    ?>