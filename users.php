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
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) <= 0){
        //TODO make something more convenient for user
        header("location: login.php");
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
  <section class="users">
    <header>
      <div class="content">
        <img src="<?php echo $img_src?>" alt="">
        <div class="details">
          <span><?php echo $name?></span>
          <p><?php echo $status ?></p>
        </div>
      </div>
      <a href="php/logout.php?user_id=<?php echo $row['unique_id']?>" class="logout">Logout</a>
    </header>
    <div class="search">
      <span class="text">Select a user to start chat</span>
      <input id="" type="text" placeholder="Enter name to search...">
      <button>
        <i class="fas fa-search"></i>
      </button>
    </div>
    <div class="users-list">
<!--        HERE MUST BE THE LIST OF USERS-->

    </div>
  </section>
</div>

<script src="javascript/users.js"></script>
</body>
</html>