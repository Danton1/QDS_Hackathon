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
        <?php $title = 'Create Comment'; ?>
        <?php include(__DIR__ . "/../src/components/header.php"); ?>

        <?php
        include("./../include_db.php");
        include("validate_functions.php");
        include("../config_session.php");

        check_user_authentication();

        if (isset($_POST['comment'])) {
            
            // Getting the data from the form
            extract($_POST);

            // Sanitizing the post data
            // $post = sanitize_input($post);
            $post = $_POST['post'];

            // If one of the fields is empty, redirect to index
            if (empty($post)) {
                header('Location: /../index.php');
                exit;
            }    

            // $SQL_insert_data = "INSERT INTO comments (postID, comment, commenterID, commenterName)
            // VALUES ('$post_id', '$post', '$commenter_id', '$commenter_name')";

            // $db->exec($SQL_insert_data);
            // $changes = $db->changes();
            $stmt = $db->prepare("INSERT INTO comments (postID, comment, commenterID, commenterName) VALUES (:post_id, :post, :commenter_id, :commenter_name)");
            $stmt->bindValue(':post_id', $_POST['post_id'], SQLITE3_INTEGER);
            $stmt->bindValue(':post', $post, SQLITE3_TEXT); 
            $stmt->bindValue(':commenter_id', $_POST['commenter_id'], SQLITE3_INTEGER);
            $stmt->bindValue(':commenter_name', $_POST['commenter_name'], SQLITE3_TEXT);

            $result = $stmt->execute();

            header('Location: display_post.php?id=' . $post_id);
            exit;
        }
        ?>

        <!-- Main -->
        <?php include(__DIR__ . "/../src/components/footer.php"); ?>
    </div>

    <script src="../src/js/app.js"></script>
</body>

</html>