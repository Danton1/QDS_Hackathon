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
                var selectFilter = $('<select name="filter"></select>'); // Create select element
                selectFilter.append('<option value="" disabled selected>Filter by</option>');
                selectFilter.append('<option value="General">General</option>')
                $.each(courses, function(i, course){
                    selectFilter.append('<option value="'+course.CourseNum+'">'+course.CourseName+'</option>');
                });
                filterListing.append(selectFilter);
            }
        });
    });

    $(document).on('change', 'select[name="filter"]', function() {
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

<div class="filter_wrap">

    <h1></i>Filter Posts</h1>
    <form action="/../index.php" method="post">
        <input type="hidden" for="id" name="id" id="id" value="<?php echo $id; ?>" />
        <input type="hidden" for="program" name="program" id="program" value="<?php echo $program; ?>" />
        <input type="hidden" name="course" id="course" value="">

        <select name="term" id="filterTerm">
            <option value="" disabled selected>Term</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <!-- <option value="5">5</option> -->
            <option value="co-op">Co-op</option>
        </select>
    
        <div id="filterListing"></div>
    
        <div class='filter'>
            <input type="submit" value="Apply" name="filter" />
        </div>
    </form>
    <a href="/../index.php"><button>All</button></a>
</div>