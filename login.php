<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Login | Student Social Media</title>
</head>
<body>

    <div class="wrap">
        <!-- Navbar -->
        <?php 
            $title = 'Login';
            define('BYPASS_AUTH', true);
            include("config_session.php");
            include("src/components/header.php");
        
            if (isset($_SESSION['success'])) {
                echo "<p class='success'>{$_SESSION['success']}</p>";
                unset($_SESSION['success']);
            } 
        ?>

        <!-- Main -->
        <div class="main_wrap">
            <div class="login">
                <?php
                    if (isset($_SESSION['errors'])) {
                        echo "<p class='error'>{$_SESSION['errors']}</p>";
                        unset($_SESSION['errors']);
                    }
                ?>
                <div class="avatar">
                    <img src="/src/imgs/user.png" alt="profile img">
                </div>
                <form class="login_wrap" action="src/controllers/login_controller.php" method="POST">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input id="confirm" type="submit" value="Log in" class="confirm">
                    <a href="signup.php">Don't have an account?</a>
                </form>
            </div>
        </div>

        <?php include("src/components/footer.php"); ?>
    <!-- </div> -->
    </div>
    

    <script src="./src/js/app.js"></script>
</body>
</html>