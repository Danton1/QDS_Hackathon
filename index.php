<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Student Social Media</title>
</head>
<body>
    <!-- <div class="wrap"> -->
  
</div>
        <!-- Navbar -->
        <?php $title = 'Student Social Media'?>
        <?php 
        include("src/components/header.php"); 
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db

        // Prints the table
        $res = $db->query('SELECT * FROM posts');

        // TODO: Made a table, going to need to fix front end to match figma
        $count = 1;
        echo "<main class='container'>\n";
        while ($row = $res->fetchArray()) {
        echo "<div class='post'>\n";
        echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['2']}</h1>\n"; // Title
        echo "<p>{$row['3']}</p>";  // Post
        echo "<a href='/posts/display_post.php?id={$row['0']}'>...Read More</a>";
        echo "<div class='stats'>\n";
        echo "<div><i class='fa-regular fa-user'></i>{$row['1']}</div>\n";  // UserID
        echo "<div><i class='fa-regular fa-clock'></i>{$row['5']}</div>\n";  // Date
        echo "<div><i class='fa-regular fa-thumbs-up'></i>{$row['4']}</div>\n";  // Likes
        echo "<div><i class='fa-regular fa-comment'></i>{$row['4']}</div>\n";  // Likes
        echo "</div>\n";



            $count++; 
            echo "</div>\n";
        };
        echo "</main>\n";
        ?>
        
        <?php include("src/components/footer.php"); ?>
    <!-- </div> -->

    <script src="./src/js/app.js"></script>
</body>
</html>