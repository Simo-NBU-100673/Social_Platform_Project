<?php
session_start();
//if no session with unique_id(user logged in) is set, redirect to login page
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<?php
//    LOGIC
//include DB configuration file
include_once "php/config.php";

//This is the user that we want to chat with
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");

//If user is not found redirect to users.php
if(mysqli_num_rows($sql) <= 0){
    header("location: users.php");
}

$row = mysqli_fetch_assoc($sql);
//TODO throw and handle exception somehow if user is not found

$name = $row['first_name'] . " " . $row['last_name'];
$status = $row['status'];

$img_src = "images/no-profile-picture-icon.svg";
if(!empty($row['img'])) {
    $img_src = "php/images/" . $row['img'];

    //check if file exists
    if(!file_exists($img_src)) {
        $img_src = "images/no-profile-picture-icon.svg";
    }
}
?>

<?php
include_once "header.php";
?>
<body>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <a href="users.php" class="back-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
            <img src="<?php echo $img_src?>" alt="">
            <div class="details">
                <span><?php echo $name?></span>
                <p><?php echo $status?></p>
            </div>

        </header>

        <div class="chat-box">
<!--            Here will come the messages from AJAX-->
        </div>

        <form action="#" class="typing-area" autocomplete="off">
<!--            THIS WILL INDICATE FROM WHOM TO WHOM IS THE MESSAGE-->
            <input type="text" name="sender_id" value="<?php echo $_SESSION['unique_id']?>" hidden>
            <input type="text" name="receiver_id" value="<?php echo $user_id?>" hidden>

            <input type="text" name="message" class="input-field" placeholder="Type a message here">
            <button><i class="fab fa-telegram-plane"></i></button>
        </form>

    </section>
</div>

<script src="javascript/chat.js"></script>
</body>
</html>