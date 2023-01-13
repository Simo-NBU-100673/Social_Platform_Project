<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RealTime Chat</title>
    <link rel="stylesheet" href="base_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
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