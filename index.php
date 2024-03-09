<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Student Social Media</title>
</head>

<body>

    <div class="wrap">
        
        <!-- Navbar -->
        <?php $title = 'Student Social Media' ?>
        <?php
        include("src/components/header.php");
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db

        // session user id
        // $id = $_SESSION['id'];
        ?>

    <!-- main -->
    <main class='container'>
        <?php
        include("posts/create_post_form.php");
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


                echo "<div class='post'>\n";
                echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['3']}</h1>\n"; // Title
                echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
                echo "<p>{$row['4']}</p>";  // Post
                echo "<a href='/posts/display_post.php?id={$row['0']}'>...Read More</a>";
                echo "<div class='stats'>\n";
                echo "<div><i class='fa-regular fa-user'></i>{$row['1']}</div>\n";  // UserID
                echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date
                echo "<div><i class='fa-regular fa-thumbs-up'></i>{$row['5']}</div>\n";  // Likes
                echo "<div><i class='fa-regular fa-comment'></i>{$comments}</div>\n";  // comments
                echo "</div>\n";

                $count++;
                echo "</div>\n";
            };
            ?>
        </main>
        </div>
        
        <?php include("src/components/footer.php"); ?>
    
    </div>

    <script src="./src/js/app.js"></script>
</body>

</html>