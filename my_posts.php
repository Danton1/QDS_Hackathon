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
    <title>Viewing Posts</title>
</head>
<body>
    <div class="wrap">

        <!-- Navbar -->
        <?php $title = 'Viewing Posts'?>
        <?php 
        include("config_session.php");
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db
        include("src/components/header.php"); 

        function edit() {
            session_regenerate_id();
            $_SESSION['last_regeneration_time'] = time();
        }
        ?>

        <main class ='main_wrap'>
            <?php
            $id = $_SESSION['id'];
            $res = $db->query('SELECT * FROM posts WHERE UserID = ' . $id);
            while ($row = $res->fetchArray()) {
                echo "<div class='post'>\n";
                    echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['3']}</h1>\n"; // Title
                    echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
                    echo "<p>{$row['4']}</p>";  // Post
                    echo "<div class='stats'>\n";
                        echo "<div><i class='fa-regular fa-user'></i>{$row['1']}</div>\n";  // UserID
                        echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date
                        echo "<div><i class='fa-regular fa-thumbs-up'></i>{$row['5']}</div>\n";  // Likes
                        echo "<div><a href='posts/delete_post.php?id={$row['0']}'><i class='fa-regular fa-trash'></i>Delete</a></div>\n";  // Delete
                        echo "<div><i class='fa-regular fa-pen'></i>Edit</div>\n";  // Edit
                    echo "</div>\n";
                echo "</div>\n";
            };
            ?>
        </main>

        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>
</html>