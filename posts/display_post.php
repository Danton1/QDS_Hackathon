<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/../src/css/reset.css">
    <link rel="stylesheet" href="/../src/css/index.css">
    <link rel="stylesheet" href="/../src/css/post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Viewing Post</title>
</head>

<body>
    <!-- <div class="wrap"> -->
        <!-- Navbar -->
        <?php $title = 'Viewing Post'; ?>
        <?php
        include("./../config_session.php");
        include(__DIR__ . "/../src/components/header.php");
        include("./../include_db.php");  // Connects the the db

        // Getting id from the url
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stm = $db->prepare('SELECT * FROM posts WHERE ID = :id');
            $stm->bindValue(':id', "$id", SQLITE3_TEXT);
            $res = $stm->execute();

            $row = $res->fetchArray(SQLITE3_NUM);
            if ($row === false) {   
                header('Location: /../index.php');
                exit;
            }
            $UserName = $row[1];
            $userid = $row[2];
            $title = $row[3];
            $post = $row[4];
            $likes = $row[5];
            $date= $row[6];
            
            echo "<div class='post'>\n";
            echo '<div class="post_header">';
            echo '<div class="post_avatar">';
            echo '<img src="https://cdn3.emoji.gg/emojis/9069-sadcat-thumbsup.png" alt="user profile">';
            echo '</div>';
            echo '<div class="post_info">';
            echo '<ul class="post_user">';
            echo "<li>{$row['1']}</li>";  // UserID
            echo '<li class="post_term">Term 1 | CST</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo "<div class='post_desc'>\n";
            echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['3']}</h1>\n"; // Title
            echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
            echo "<p>{$row['4']}</p>";  // Post
            echo "<div class='stats'>\n";
            echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date
            echo "<div><i class='fa-regular fa-thumbs-up'></i>{$row['5']}</div>\n";  // Likes
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
        } else {
            header('Location: /../index.php');
            exit;
        }
        ?>


        <?php 
        $res = $db->query("SELECT * FROM comments WHERE PostID = $id");
        while ($row = $res->fetchArray()) {

                echo "<div class='post'>\n";
                echo '<div class="post_header">';
                echo '<div class="post_avatar">';
                echo '<img src="https://source.unsplash.com/random/200x200" alt="user profile">';
                echo '</div>';
                echo '<div class="post_info">';
                echo '<ul class="post_user">';
                echo "<li>{$row['4']}</li>";  // UserID
                // echo "<li class='post_term'>{$row['7']} | {$row['8']}</li>";
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo "<div class='post_desc'>\n";
                // echo "<h1>{$row['3']}</h1>\n"; // Title
                // echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
                echo "<p><i class='fa-solid fa-chevron-right'></i> {$row['2']}</p>";  // Post
                echo "</div>\n";
                echo "</div>\n";
            };

            $logged_user_id = $_SESSION['id'];
            $res = $db->query("SELECT * FROM users WHERE ID = $logged_user_id");
            $row = $res->fetchArray();
            $logged_user_name = $row['1'];
        ?>

        <?php include(__DIR__ . "/../src/components/footer.php"); ?>
    </div>
    </div>
    <form action="/posts/create_comment.php" method="post">
        <div class="comment new-post">
            <label for="post">Add a new comment: </label>
            <textarea for="post" name="post" id="post"></textarea>
        </div>
        <input type="hidden" for="post_id" name="post_id" id="post_id" value="<?php echo $id; ?>">
        <input type="hidden" for="commenter_id" name="commenter_id" id="commenter_id" value="<?php echo $logged_user_id; ?>">
        <input type="hidden" for="commenter_name" name="commenter_name" id="commenter_name" value="<?php echo $logged_user_name; ?>">
        <input type="submit" value="comment " name="comment" />
    </form>
    <script src="../src/js/app.js"></script>
</body>

</html>