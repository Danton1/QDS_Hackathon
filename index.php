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
        <?php $title = 'Student Social Media' ?>
        <?php
        include("src/components/header.php");
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db

        // session user id
        // $id = $_SESSION['id'];
        ?>

        <form action="posts/create_post.php" method="post">
            <div>
                <label for="title">Title: </label>
                <input for="title" name="title" id="title" />
            </div>

            <div>
                <label for="post">Post: </label>
                <input for="post" name="post" id="post" />
            </div>

            <!-- When session is implemented use this, otherwise test user Kim, ID = 1 -->
            <!-- <input type="hidden" name="id" value="<?php //echo $id; 
                                                        ?>"> -->
            <input type="hidden" name="id" value=1>

            <div>
                <input type="submit" value="create" name="create" />
            </div>
        </form>

        <?php
        // Prints the table
        $res = $db->query('SELECT * FROM posts');

        // TODO: Made a table, going to need to fix front end to match figma
        $count = 1;
        while ($row = $res->fetchArray()) {
            echo "<h1>Post $count</h1>\n";
            echo "<table>\n";
            echo "<tr><th>User</th>" .
                "<th>Title</th>" .
                "<th>Post</th>" .
                "<th>Likes</th>" .
                "<th>Date</th></tr>\n";
            echo "<tr>";
            echo "<td>{$row['1']}</td>";  // UserID
            echo "<td>{$row['3']}</td>";  // Title
            echo "<td>{$row['4']}</td>";  // Post
            echo "<td>{$row['5']}</td>";  // Likes
            echo "<td>{$row['6']}</td>";  // Date
            echo "</tr>";
            echo "</table>";

            echo "<a href='/posts/display_post.php?id={$row['0']}'>View More</a>";


            $count++;
        };

        ?>

        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>

</html>