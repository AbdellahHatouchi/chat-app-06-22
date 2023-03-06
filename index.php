
<!DOCTYPE html>
<html lang="en">
<?php
    require('header.php')
?>
<body>
    <div class="wrapper">
        <section class="from sginup">
            <h1>RealTime Chat App</h1>
            <form id='myform' method="POST" enctype="multipart/form-data">
                <div class='error-txt' id="error"></div>
                <div class="photo">
                    <img src="image/people.png" alt="" width="100" height="100" id="image">
                    <div class="round">
                        <input type="file" id="file" accept="image/*" name="image">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                <div class="name-details">
                    <div class="field">
                        <input type="text" id="fname" required placeholder=" " name="fname">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="field">
                        <input type="text" id="lname" required placeholder=" " name="lname">
                        <label for="lname">Last Name</label>
                    </div>
                </div>
                <div class="field">
                    <input type="email" id="email" required placeholder=" " name="email">
                    <label for="email">Email</label>
                </div>
                <div class="field">
                    <input type="password" id="password" required placeholder=" " name="password">
                    <label for="password">Password</label>
                    <i class="fa-solid fa-eye-slash" id="eye"></i>
                </div>
                <div class="submit">
                    <input class="btn-s" type="submit" value="SignUp" name="submit" id="submit">
                </div>
                <span>you already have an account ? </span><a href="login.php">SignIn</a>
            </form>
        </section>
    </div>
    <script src="javaScript/eye.js"></script>
    <script src="javaScript/imageSignup.js"></script>
    <script src="javaScript/signup.js"></script>
</body>
</html>