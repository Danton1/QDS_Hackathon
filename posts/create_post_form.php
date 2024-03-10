<?php 

$id = $_SESSION['id'];
$stmt = $db->prepare('SELECT ProgramName FROM users WHERE ID = :id');
$stmt->bindvalue(':id', $id, SQLITE3_TEXT);

$res = $stmt->execute();
$row = $res->fetchArray();
$program = $row['ProgramName'];
?>


<h1>Create a Post</h1>
<form action="/posts/create_post.php" method="post">
    <div>
        <label for="title">Title: </label>
        <input for="title" name="title" id="title" />
    </div>

    <div>
        <label for="post">Post: </label>
        <input for="post" name="post" id="post" />
    </div>
    
    <input type="hidden" for="id" name="id" id="id" value="<?php echo $id; ?>">
    <input type="hidden" for="program" name="program" id="program" value="<?php echo $program; ?>">

    <div>
        <input type="submit" value="create" name="create" />
    </div>
</form>