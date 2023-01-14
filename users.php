<?php
    session_start();
    //if no session with unique_id(user logged in) is set, redirect to login page
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>

<?php
    include_once "header.php";
?>
<body>
<div class="wrapper">
  <section class="users">
    <header>
        <?php

        ?>
      <div class="content">
        <img src="images/no-profile-picture-icon.svg" alt="">
        <div class="details">
          <span>Coding Simo</span>
          <p>Active now</p>
        </div>
      </div>
      <a href="#" class="logout">Logout</a>
    </header>
    <div class="search">
      <span class="text">Select a user to start chat</span>
      <input id="" type="text" placeholder="Enter name to search...">
      <button>
        <i class="fas fa-search"></i>
      </button>
    </div>
    <div class="users-list">
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 1</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
      <a href="#">
        <div class="content">
          <img src="images/no-profile-picture-icon.svg" alt="">
          <div class="details">
            <span>Coding Simo 2</span>
            <p>This is test</p>
          </div>
        </div>
        <div class="status-dot">
          <i class="fas fa-circle"></i>
        </div>
      </a>
    </div>
  </section>
</div>

<script src="javascript/users.js"></script>
</body>
</html>