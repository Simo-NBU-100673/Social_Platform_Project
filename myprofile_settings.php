<?php
    session_start();
    //if there is not a session with unique_id(user logged in) set, redirect to login page
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }

    //if there is no user_id in the url, redirect to users.php
    if(!isset($_GET['user_id'])){
        header("location: users.php");
    }

    include_once "php/config.php";

    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    //if the user_id in the url is not the same as the user logged in, redirect to users.php
    if($_SESSION['unique_id'] != $user_id){
        header("location: users.php");
    }

    $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = {$user_id}");

    if(mysqli_num_rows($sql) <= 0){
        header("location: users.php");
    }

    $row = mysqli_fetch_assoc($sql);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $password = $row['password'];

?>

<?php
include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="form signup">

            <header>Your Profile Information</header>
            <form enctype="multipart/form-data">
                <div class="error-message"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" name="first_name" value="<?php echo $first_name?>">
                    </div>
                    <div class="field input">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" name="last_name" value="<?php echo $last_name?>">
                    </div>
                </div>
                <div class="field input">
                    <label for="email_address">Email Address</label>
                    <input id="email_address" type="text" name="email_address" value="<?php echo $email?>">
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" value="<?php echo $password?>">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Your image</label>
                    <input  type="file" name="image">
                </div>
                <div class="field button">
                    <input type="submit" value="Save changes">
                    <input type="button" class="delete-account" value="Delete Account">
                </div>
            </form>

        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <!-- <script src="javascript/delete-account.js"></script>
    <script src="javascript/change-account.js"></script> -->
</body>
</html>