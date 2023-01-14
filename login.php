<?php
include_once "header.php";
?>
<body>
<div class="wrapper">
  <section class="form login">

    <header>Realtime Chat App</header>
    <form action="#">
      <div class="error-message"></div>
      <div class="field input">
        <label for="email_address">Email Address</label>
        <input id="email_address" type="text" name="email" placeholder="Enter your email">
      </div>
      <div class="field input">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Enter your password">
        <i class="fas fa-eye"></i>
      </div>
      <div class="field button">
        <input type="submit" value="Continue to Chat">
      </div>
    </form>

    <div class="link">
      Not yet signed up?
      <a href="index.php">Signup now</a>
    </div>

  </section>
</div>

<script src="javascript/pass-show-hide.js"></script>
<script src="javascript/login.js"></script>
</body>
</html>