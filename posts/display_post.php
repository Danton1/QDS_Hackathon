<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/../src/css/reset.css">
    <link rel="stylesheet" href="/../src/css/post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Viewing Post</title>
</head>

<body>
    <div class="wrap">
        <!-- Navbar -->
        <?php $title = 'Viewing Post'; ?>
        <?php
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
        } else {
            header('Location: /../index.php');
            exit;
        }
        ?>

        <table>
            <tr>
                <td>Username:</td>
                <td><a href="/../profile.php?id=<?php echo $userid ?>"><?php echo $UserName ?></a></td>
            </tr>
            <tr>
                <td>Title: </td>
                <td><?php echo $title ?></td>
            </tr>
            <tr>
                <td>Post: </td>
                <td><?php echo $post ?></td>
            </tr>
            <tr>
                <td>likes: </td>
                <td><?php echo $likes ?></td>
            </tr>
            <tr>
                <td>date: </td>
                <td><?php echo $date ?></td>
            </tr>
        </table>
        <br />

        <?php 
        $res = $db->query("SELECT * FROM comments WHERE PostID = $id");
        while ($row = $res->fetchArray()) {
            echo "<table>\n";
            echo "<tr><th>User</th>".
                    "<th>comment</th></tr>\n";
                echo "<tr>";
                echo "<td>{$row['4']}</td>";  // Username
                echo "<td>{$row['2']}</td>";  // Comment
                echo "</tr>";
                echo "</table>";    
            };


        ?>

        <?php include(__DIR__ . "/../src/components/footer.php"); ?>
    </div>

    <script src="../src/js/app.js"></script>
</body>

</html>