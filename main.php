<?php
    session_start();
    if (count($_SESSION) === 0) {
        header("Location: login.php");
        exit;
    }
    

?>


<!DOCTYPE html>
<html lang="en">

<?php
    require('header.php')
?>

<body>
    <div class="wrapper">
        <section class="user">
            <header data=<?php echo $_SESSION['idUser'] ?>>
                <div class="content">
                    <img src="<?php $_SESSION["image"] !== null ? $img=$_SESSION["image"]: $img ='images/people.png' ;echo $img;?>" alt="" width="50" height="50">
                    <div class="details">
                        <span><?php echo ucfirst($_SESSION['fname']) . " " . ucfirst($_SESSION['lname']) ?></span>
                        <p>Active New</p>
                    </div>
                </div>
                <a href="logout.php" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" id="search" placeholder="Enter name to search ...">
                <button class="btn-search" id="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="users-list" id="users-list">
                <div class="spinner">
                    <span class="border-spinner"></span>
                </div>
                <!-- <a href="chat.php">
                    <div class="content">
                        <img src="image/people.png" alt="" width="50" height="50">
                        <div class="details">
                            <span>Abellah Hatouchi</span>
                            <p>This is last message</p>
                        </div>
                    </div>
                    <div class="satuts online"><i class="fa-solid fa-circle"></i></div>
                </a>
                <a href="#">
                    <div class="content">
                        <img src="image/people.png" alt="" width="50" height="50">
                        <div class="details">
                            <span>Abellah Hatouchi</span>
                            <p>This is last message</p>
                        </div>
                    </div>
                    <div class="satuts offline"><i class="fa-solid fa-circle"></i></div>
                </a>-->
                
            </div>
        </section>
    </div>
    <script src="javaScript/getuser.js"></script>
</body>

</html>