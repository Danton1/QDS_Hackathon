<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/home.css">
    <link rel="stylesheet" href="./src/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Student Social Media</title>
</head>

<body>

    <!-- <div class="wrap"> -->
        
        <!-- Navbar -->
        <?php $title = 'Student Social Media' ?>
        <?php
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db
        include("config_session.php");
        include("src/components/header.php");
        ?>

    <!-- main -->
    <main class='main_wrap'>
        <!-- <div class="home"> -->
            <div class="program_btn">
                <a href="./program.php">Go to CST channel
                <i class="fa-solid fa-angle-right"></i></a>
            </div>
        <?php
        echo "<div class='post new-post' id='new_post'>\n";
        include("posts/create_post_form.php");
        echo "</div>\n";
        include("posts/filter_post_search.php");


        // Prints the table
        $res = $db->query('SELECT * FROM posts');
        $count = 1;
        while ($row = $res->fetchArray()) {

                // Getting the number of comments
                $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM comments WHERE postID = :id');
                $stmt->bindValue(':id', $row['0'], SQLITE3_INTEGER);
                $res2 = $stmt->execute();
                $row2 = $res2->fetchArray(SQLITE3_ASSOC);
                $comments = $row2['cnt'];


                echo "<a href='/posts/display_post.php?id={$row['0']}'>\n";
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
                echo "<span>...Read More</span>\n";
                echo "<div class='stats'>\n";
                echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date
                echo "<div><i class='fa-regular fa-thumbs-up'></i>{$row['5']}</div>\n";  // Likes
                echo "<div><i class='fa-regular fa-comment'></i>{$comments}</div>\n";  // comments
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</a>\n";

                $count++;
                // echo "</div>\n";
            };
            ?>
        <!-- </div> -->
    </main>
        <!-- </div> -->
        
        <?php include("src/components/footer.php"); ?>
    
    <!-- </div> -->

    <script src="./src/js/app.js"></script>
</body>

</html>