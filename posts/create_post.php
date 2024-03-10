<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/../src/css/reset.css">
    <link rel="stylesheet" href="/../src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Creating Post</title>
</head>

<body>
    <div class="wrap">
        <!-- Navbar -->
        <?php $title = 'Create Post'; ?>
        <?php include(__DIR__ . "/../src/components/header.php"); ?>

        <?php
        include("./../include_db.php");
        include("validate_functions.php");
        include("../config_session.php");

        check_user_authentication();

        if (isset($_POST['create'])) {
            
            // Getting the data from the form
            extract($_POST);

            // Sanitizing the post data
            $post = sanitize_input($post);
            $title = sanitize_input($title);
            echo $course;

            // If one of the fields is empty, redirect to index
            if (empty($title) || empty($post) || empty($course)) {
                header('Location: /../index.php');
                exit;
            }

            // Find user information from db
            $stm = $db->prepare('SELECT * FROM users WHERE ID = :id');
            $stm->bindValue(':id', "$id", SQLITE3_TEXT);
            $res = $stm->execute();

            $row = $res->fetchArray(SQLITE3_NUM);
            if ($row === false) {
                header('Location: /../index.php');
                exit;
            }
            $userid = $row[0];
            $name = $row[1];

            $SQL_insert_data = "INSERT INTO posts (UserName, UserID, title, post, likes, date, program, course)
            VALUES ('$name', '$userid', '$title', '$post', 0, date('now'), '$program', '$course')";

            $db->exec($SQL_insert_data);
            $changes = $db->changes();


            echo $program;
            header('Location: ../../index.php');
            exit;
        }
        ?>

        <!-- Main -->
        <?php include(__DIR__ . "/../src/components/footer.php"); ?>
    </div>

    <script src="../src/js/app.js"></script>
</body>

</html>