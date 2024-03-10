<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('select[name="term"]').change(function(){
        var term = $(this).val();
        $.ajax({
            url: 'posts/get_courses.php',
            type: 'get',
            data: {term: term},
            success: function(response){
                var courses = JSON.parse(response);
                var courseListing = $('#courseListing');
                courseListing.empty();
                courseListing.append('<input type="radio" name="course" id="general" value="General"><label for="course">General</label><br>')
                $.each(courses, function(i, course){
                    courseListing.append('<input type="radio" name="course" id="course" value="'+course.CourseNum+'"><label for="course'+i+'">'+course.CourseName+'</label><br>');
                });
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


<h1></i>Create a Post</h1>
<form action="/posts/create_post.php" method="post">
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

    <select name="term">
        <option value="" disabled selected>Term</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="co-op">Co-op</option>
    </select>

    <div id="courseListing"></div>

    <div class='create'>
        <input type="submit" value="Create " name="create" />
    </div>
</form>