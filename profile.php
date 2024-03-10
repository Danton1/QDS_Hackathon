<!-- <?php #require_once('config_session.php') ?> -->
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
        <?php include("src/components/header.php");
        include("./include_db.php");
        include("config_session.php");  

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
        } else if(isset($_SESSION['id'])) {
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
            $program = $row[2];
            $term = $row[3];
        } else {
            header('Location: /../login.php');
            exit;
        }
        ?>

        <!-- Displays user information -->
        <div>
            <div>
                <p>Username:</p>
                <p><?php echo $name ?></a></p>
            </div>
            <div>
                <p>Program: </p>
                <p><?php echo $program ?></p>
            </div>
            <div>
                <p>Term: </p>
                <p><?php echo $term ?></p>
            </div>
        </div>

        <!-- Displays user posts -->
        <?php 
        $res = $db->query("SELECT * FROM posts WHERE UserID = $userid");

        $count = 1;
        while ($row = $res->fetchArray()) {
            echo "<h1>Post $count</h1>\n";
            echo "<table>\n";
            echo "<tr><th>Title</th>".
                    "<th>Post</th>".
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