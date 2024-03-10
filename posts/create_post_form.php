<h1>Create a Post</h1>
<form action="create_post.php" method="post">
    <div>
        <label for="title">Title: </label>
        <input for="title" name="title" id="title" />
    </div>

    <div>
        <label for="post">Post: </label>
        <textarea for="post" name="post" id="post"></textarea>
    </div>

    <!-- or read session program -->
    <select name="program"> 
        <option value="" disabled selected>Choose your program</option>
        <?php
        $results = $db->query("SELECT * FROM programs");
        while ($row = $results->fetchArray()) {
            echo "<option value='{$row['ProgramID']}'>{$row['ProgramName']}</option>";
        }
        ?>
    </select>
    

    <!-- When session is implemented use this, otherwise test user Kim, ID = 1 -->
    <!-- <input type="hidden" name="id" value="<?php //echo $id; 
                                                ?>"> -->
    <input type="hidden" name="id" value=1>

    <div class='create'>
        <input type="submit" value="Create 👉" name="create" />
    </div>
</form>