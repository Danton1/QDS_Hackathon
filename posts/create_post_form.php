<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#createTerm').change(function(){
        var term = $(this).val();
        $.ajax({
            url: 'posts/get_courses.php',
            type: 'get',
            data: {term: term},
            success: function(response){
                var courses = JSON.parse(response);
                var courseListing = $('#courseListing');
                courseListing.empty();
                var selectElement = $('<select name="course"></select>'); // Create select element
                selectElement.append('<option value="" disabled selected>Choose a channel</option>');
                selectElement.append('<option value="General">General</option>');
                $.each(courses, function(i, course){
                    selectElement.append('<option value="'+course.CourseNum+'">'+course.CourseName+'</option>');
                });
                courseListing.append(selectElement); // Append select element to courseListing
            }
        });
    });
});
</script>

<?php 

$id = $_SESSION['id'];
$stmt = $db->prepare('SELECT ProgramName FROM users WHERE ID = :id');
$stmt->bindvalue(':id', $id, SQLITE3_TEXT);

$res = $stmt->execute();
$row = $res->fetchArray();
$program = $row['ProgramName'];
?>
    
<input type="checkbox" name="new-post-btn" id="new-post-btn" />
<label for="new-post-btn"><h1>Create a Post</h1></label>

<form id="new-post-form" action="/posts/create_post.php" method="post">
    <div>
        <label for="title">Title: </label>
        <input for="title" name="title" id="title" />
    </div>

    <div>
        <label for="post">Post: </label>
        <textarea for="post" name="post" id="post"></textarea>
    </div>
    
    <input type="hidden" for="id" name="id" id="id" value="<?php echo $id; ?>">
    <input type="hidden" for="program" name="program" id="program" value="<?php echo $program; ?>">

    <select name="term" id="createTerm">
        <option value="" disabled selected>Term</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="co-op">Co-op</option>
    </select>
    <div id="courseListing"></div>
    <div class='create'>
        <input type="submit" value="Create " name="create" />
    </div>
</form>
