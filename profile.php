<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Profile | Student Social Media</title>
</head>

<body>
    <div class="wrap">
        <!-- Navbar -->
        <?php $title = 'Profile' ?>
        <?php 
        include("./include_db.php");
        include("config_session.php");  
        include("src/components/header.php");
    ?>
    <div class="wrap">
        <?php
        // Getting id from the url
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

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
            $program = $row[2];
            $term = $row[3];
        } else if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];

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
            $program = $row[4];
            $term = $row[5];
        } else {
            header('Location: /../login.php');
            exit;
        }
        ?>

        <div class="main_wrap">
            <div class="container">
                <div class="profile_wrap">
                    <div class="avatar">
                        <img src="data:image/jpeg;base64,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" alt="profile img">
                    </div>

                    <!-- Displays user information -->
                    <div class="user_info">
                        <h3 class="user_name"><?php echo $name ?></a></h3>
                        <div class="term_info">
                            <p><?php echo $program; ?></p>
                            <p>Term <?php echo $term; ?></p>
                        </div>
                    </div>
                </div>
                <ul class="profile_options">
                    <li class="mypost">
                        <a href="./my_posts.php">See my posts</a>
                    </li>
                </ul>
                <!-- <div class="post_wrap">
                    <div class="myPost_title">
                        <h3>My posts</h3>
                        <select name="filter" id="filter_posts">
                            <option value="" disabled selected>Filter by</option>
                            <option value="term">Filter by term</option>
                            <option value="course">Filter by course</option>
                            <option value="date">Filter by date</option>
    
                        </select>
                    </div>
                    <div class="post"></div>
                    <div class="post"></div>
                    <div class="post"></div>
                    <div class="post"></div>
                </div> -->
            </div>
        </div>

        <!-- Displays user posts -->
        <?php
        $res = $db->query("SELECT * FROM posts WHERE UserID = $userid");

        $count = 1;
        while ($row = $res->fetchArray()) {
            echo "<h1>Post $count</h1>\n";
            echo "<table>\n";
            echo "<tr><th>Title</th>" .
                "<th>Post</th>" .
                "<th>Date</th></tr>\n";
            echo "<tr>";
            echo "<td><a href='/posts/display_post.php?id={$row['0']}'>{$row['3']}</a></td>";  // Title
            echo "<td>{$row['4']}</td>";  // Post
            echo "<td>{$row['6']}</td>";  // Date
            echo "</tr>";
            echo "</table>";

            $count++;
        };
        ?>

        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>

</html>