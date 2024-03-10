<?php
    include("../include_db.php");  // Connects the the db

    $id = $_GET['id'];
    $stm = $db->prepare('DELETE FROM posts WHERE ID = :id');
    $stm->bindValue(':id', "$id", SQLITE3_TEXT);
    $res = $stm->execute();

    if ($res) {
        header('Location: ../my_posts.php');
        exit;
    }
?>