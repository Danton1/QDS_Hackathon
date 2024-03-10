<?php
define('BYPASS_AUTH', true);
require_once('config_session.php');
require_once('include_db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/signup.css">
    <link rel="stylesheet" href="./src/css/error.css">
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
        <div class="main_wrap">
            <?php
                if (isset($_SESSION['errors'])) {
                    foreach ($_SESSION['errors'] as $error) {
                        echo "<div class='error'><i class='fa-solid fa-circle-exclamation'></i><h1>Error !</h1><p>$error</p><input type='submit' class='error_close' value='Ok'></input></div>";
                    }
                    unset($_SESSION['errors']);
                } 
            ?>
            <div class="form-container">

                <div class="avatar">
                    <img src="/src/imgs/user.png" alt="profile img">
                </div>
                <form class="signup_wrap" action="src/controllers/signup_controller.php" method="post">
                    <input type="text" name="username" placeholder="User name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <div class="select_wrap">
                        <select name="program" id="programSelect" onchange="updateTermsSelect()">
                            <option value="" disabled selected>Program</option>
                            <?php
                                $results = $db->query("SELECT * FROM programs");
                                while ($row = $results->fetchArray()) {
                                    echo "<option value='{$row['ProgramID']}'>{$row['ProgramName']}</option>";
                                }
                            ?>
                        </select>

                        <select name="term" id="termSelect" disabled>
                            <option value="" disabled selected>Term</option>
                        </select>
                    </div>
                    <input id="confirm" type="submit" value="Create account">
                    <a href="login.php">Already have an account?</a>
                </form>
            </div>
        </div class="main_wrap">
    
        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>
</html>

<script>
function updateTermsSelect() {
    const programSelect = document.getElementById('programSelect').value;
    const termSelect = document.getElementById('termSelect');

    // Perform AJAX request to fetch program details
    fetch('src/controllers/get_program_details.php?programId=' + programSelect)
        .then(response => response.json())
        .then(data => {
            const termSelect = document.getElementById('termSelect');
            termSelect.innerHTML = '<option value="" disabled selected>Term</option>'; // Reset existing options

            // Add options based on NumTerms
            for (let i = 1; i <= data.NumTerms; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                termSelect.appendChild(option);
            }

            // Add Co-op option if applicable
            if (data.Coop) {
                const coopOption = document.createElement('option');
                coopOption.value = 'co-op';
                coopOption.textContent = 'Co-op';
                termSelect.appendChild(coopOption);
            }
        });
    
    termSelect.disabled = false;
}
</script>
