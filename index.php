
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Student Social Media</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
        $title = 'Student Social Media'; 
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db
        include("config_session.php");
        include("src/components/header.php");
    ?>

    <!-- main -->
    <main class='main_wrap'>

        <?php
            include("posts/filter_post_search.php");
            
            echo "<div class='post new-post' id='new_post'>\n";
            include("posts/create_post_form.php");
            echo "</div>\n";

            $mystring = '';
            $currentUserId = $_SESSION['id'];

            // Prints the table
            if (isset($_POST['filter'])) { // If Filtered
                extract($_POST);
                $res = $db->query("SELECT * FROM posts WHERE course = '{$course}'");
            } else { // If not filtered
                $res = $db->query('SELECT * FROM posts');
            }
            $count = 1;
            while ($row = $res->fetchArray()) {
                // Getting the number of comments
                $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM comments WHERE postID = :id');
                $stmt->bindValue(':id', $row['0'], SQLITE3_INTEGER);
                $res2 = $stmt->execute();
                $row2 = $res2->fetchArray(SQLITE3_ASSOC);
                $comments = $row2['cnt'];

                // Check if the current user has liked the post
                $likedStmt = $db->prepare('SELECT COUNT(*) FROM likes WHERE user_id = :userId AND post_id = :postId');
                $likedStmt->bindValue(':userId', $currentUserId, SQLITE3_INTEGER);
                $likedStmt->bindValue(':postId', $row['0'], SQLITE3_INTEGER);
                $likedResult = $likedStmt->execute();
                $userHasLiked = $likedResult->fetchArray()[0] > 0;

                // Define the class for the like button based on whether the user has liked the post
                $likeButtonClass = $userHasLiked ? 'like-btn liked' : 'like-btn';

                $stmt = $db->prepare('SELECT Term, ProgramName FROM users WHERE ID = :id');
                $stmt->bindValue(':id', $row['2'], SQLITE3_INTEGER);
                $res3 = $stmt->execute();
                $row3 = $res3->fetchArray(SQLITE3_ASSOC);
                $term = $row3['Term'];
                $user_program = $row3['ProgramName'];


                echo "<a href='/posts/display_post.php?id={$row['0']}'>\n";
                echo "<div class='post'>\n";
                echo '<div class="post_header">';
                echo '<div class="post_avatar">';
                echo "<img src='https://source.unsplash.com/random/200x200?sig={$row['2']}' alt='user profile'>";
                echo '</div>';
                echo '<div class="post_info">';
                echo '<ul class="post_user">';
                echo "<li>{$row['1']}</li>";  // Name
                echo "<li class='post_term'>Term {$term} | {$user_program}</li>";
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo "<div class='post_desc'>\n";
                echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['3']}</h1>\n"; // Title
                echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
                echo "<p>" . nl2br(htmlspecialchars($row['4'])) . "</p>";  // Post
                echo "<span>...Read More</span>\n";
                echo "</a>\n";
                echo "<div class='stats'>\n";
                echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date

                echo "<button class='{$likeButtonClass}' data-postid='{$row['0']}'>"
                    ."<i class='fa-regular fa-thumbs-up'></i>"
                    ."<span id='like-count-{$row['0']}'>{$row['5']}</span>"
                    ."</button>\n";  // Likes button with count

                echo "<div><i class='fa-regular fa-comment'></i>{$comments}</div>\n";  // comments
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";

                $count++;
            };
            ?>
    </main>
        
        <?php include("src/components/footer.php"); ?>

    <script src="./src/js/app.js"></script>
</body>

</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postId = this.getAttribute('data-postid');
            var action = this.classList.contains('liked') ? 'unlike' : 'like';
            var formData = new FormData();
            formData.append('postId', postId);
            formData.append('action', action);
            fetch('src/controllers/update_likes.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.success) {
                    document.getElementById('like-count-' + postId).textContent = data.likes;
                    this.classList.toggle('liked'); // Toggle 'liked' class on the button
                }
            });
        });
    });
});
</script>
