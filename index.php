<?php
 session_start();
 //if session with unique_id(user logged in) is set, redirect to users page
 if(isset($_SESSION['unique_id'])){
     header("location: users.php");
 }
?>

<?php
include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="form signup">

            <header>Realtime Chat App</header>
            <form enctype="multipart/form-data">
                <div class="error-message"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" name="first_name" placeholder="First Name">
                    </div>
                    <div class="field input">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" name="last_name" placeholder="Last Name">
                    </div>
                </div>
                <div class="field input">
                    <label for="email_address">Email Address</label>
                    <input id="email_address" type="text" name="email_address" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter new password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select image</label>
                    <input  type="file" name="image">
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>

            <div class="link">
                Already signed up?
                <a href="login.php">Login now</a>
            </div>

        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>