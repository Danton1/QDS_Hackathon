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
    <title>Profile | Student Social Media</title>
</head>

<body>
    <div class="wrap">
        <!-- Navbar -->
        <?php $title = 'Profile' ?>
        <?php include("src/components/header.php");
        include("./include_db.php");

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
        } else {
            header('Location: /../login.php');
            exit;
        }
        ?>

        <table>
            <tr>
                <td>Username:</td>
                <td><?php echo $name ?></a></td>
            </tr>
            <tr>
                <td>Program: </td>
                <td><?php echo $program ?></td>
            </tr>
            <tr>
                <td>Term: </td>
                <td><?php echo $term ?></td>
            </tr>
        </table>



        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>

</html>