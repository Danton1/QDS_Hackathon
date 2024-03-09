<?php
define('BYPASS_AUTH', true);
require_once('config_session.php');
require_once('include_db.php');
require_once('setup_db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Signup | Student Social Media</title>
</head>
<body>

    <div class="wrap">
        <!-- Navbar -->
        <?php $title = 'signup'?>
        <?php include("src/components/header.php"); ?>
        
        <!-- Main -->
        <main>
            <div class="form-container">
                
                <?php
                    if (isset($_SESSION['errors'])) {
                        foreach ($_SESSION['errors'] as $error) {
                            echo "<p class='error'>$error</p>";
                        }
                        unset($_SESSION['errors']);
                    }
                ?>

                <h2>Replace me with logo</h2>
                <form action="/signup_controller.php" method="post">
                    <input type="text" name="username" placeholder="User name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <select name="program">
                        <option value="" disabled selected>Choose your program</option>
                        <?php
                            $results = $db->query("SELECT * FROM programs");
                            while ($row = $results->fetchArray()) {
                                echo "<option value='{$row['ProgramID']}'>{$row['ProgramName']}</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Create account">
                </form>
            </div>
        </main>
    
        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>
</html>