<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#filterTerm').change(function(){
        var term = $(this).val();
        $.ajax({
            url: 'posts/get_courses.php',
            type: 'get',
            data: {term: term},
            success: function(response){
                var courses = JSON.parse(response);
                var filterListing = $('#filterListing');
                filterListing.empty();
                filterListing.append('<input type="radio" name="course" id="general" value="General"><label for="course">General</label><br>')
                $.each(courses, function(i, course){
                    filterListing.append('<input type="radio" name="course" id="course" value="'+course.CourseNum+'"><label for="course'+i+'">'+course.CourseName+'</label><br>');
                });
            }
        });
    });

    $(document).on('change', 'input[name="course"]', function() {
        $('#course').val(this.value);
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


<h1></i>Filter Posts</h1>
<form action="/../index.php" method="post">
    <input type="hidden" for="id" name="id" id="id" value="<?php echo $id; ?>">
    <input type="hidden" for="program" name="program" id="program" value="<?php echo $program; ?>">

    <select name="term" id="filterTerm">
        <option value="" disabled selected>Term</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="co-op">Co-op</option>
    </select>

    <div id="filterListing"></div>

    <div class='filter'>
        <input type="submit" value="filter " name="filter" />
    </div>
</form>
<a href="/../index.php"><button>All</button></a>