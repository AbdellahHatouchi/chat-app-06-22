

<!DOCTYPE html>
<html lang="en">
<?php
    require('header.php')
?>
<body>
    <div class="wrapper">
        <section class="from sginup">
            <h1>RealTime Chat App</h1>
            <form method="POST" id="myform">
                <div class='error-txt' id="error"></div>
                <div class="field">
                    <input type="email" id="email" name="email" placeholder=" ">
                    <label for="email">Email</label>
                </div>
                <div class="field">
                    <input type="password" name="password" id="password" placeholder=" ">
                    <label for="password">Password</label>
                    <i class="fa-solid fa-eye-slash" id="eye"></i>
                </div>
                <div class="submit">
                    <input class="btn-s" type="submit" value="SignIn" id="submit">
                </div>
                <span>Create an account ? </span><a href="index.php">SignUp</a>
            </form>
        </section>
    </div>
    <script src="javaScript/eye.js"></script>
    <script src="javaScript/login.js"></script>
</body>
</html>