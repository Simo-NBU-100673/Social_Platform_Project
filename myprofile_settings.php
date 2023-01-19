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
        <section class="form changes">
            <div class="head">
                <a href="users.php" class="back-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <header>Your Profile Information</header>
            </div>
            <form enctype="multipart/form-data">
                <div class="error-message"></div>
                <div class="notification-message"></div>
                <div class="image-names-container">
                <div class="image-container">
                    <img src="php/images/<?php echo $row['img']?>" alt="">
                    <label for="image">Change image</label>
                    <input id="image" type="file" style="display:none;" name="image" accept="image/png, image/jpeg, image/jpg">
                </div>
                <div class="name-details">
                    <div class="field input">
                        <div class="first-name container">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" name="first_name" value="<?php echo $first_name?>">
                        </div>
                        <div class="last-name container">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" name="last_name" value="<?php echo $last_name?>">
                        </div>
                    </div>
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
                <div class="field button settings-buttons">
                    <input type="submit" class="save-changes" value="Save changes">
                    <input type="button" class="delete-account" value="Delete Account">
                </div>
            </form>

        </section>
    </div>

    <div class="pop-up">
        <div class="pop-up-container">
            <div class="pop-up-header">
                <h3>Are you sure you want to delete your account?</h3>
            </div>
            <div class="pop-up-buttons">
                <button class="cancel"><i class="fas fa-times"></i></button>
                <button class="confirm"><i class="fas fa-check"></i></button>
            </div>
        </div>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/myprofile-settings.js"></script>
</body>
</html>