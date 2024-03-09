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
    <div class="wrap">
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
        while ($row = $res->fetchArray()) {
        echo "<h1>Post $count</h1>\n";
        echo "<table>\n";
        echo "<tr><th>User</th>".
                "<th>Title</th>".
                "<th>Post</th>".
                "<th>Likes</th>" .
                "<th>Date</th></tr>\n";
            echo "<tr>";
            echo "<td>{$row['1']}</td>";  // UserID
            echo "<td>{$row['2']}</td>";  // Title
            echo "<td>{$row['3']}</td>";  // Post
            echo "<td>{$row['4']}</td>";  // Likes
            echo "<td>{$row['5']}</td>";  // Date
            echo "</tr>\n";
            echo "</table>\n";
            $count++; 
        };

        ?>
        
        <?php include("src/components/footer.php") ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>
</html>