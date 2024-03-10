<?php require_once(__DIR__ . "/../config_session.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/../src/css/reset.css">
    <link rel="stylesheet" href="/../src/css/index.css">
    <link rel="stylesheet" href="/../src/css/post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BCIT Student Social Media">
    <meta name="keywords" content="BCIT, Student, Social, Media">
    <title>Viewing Post</title>
</head>

<body>
    <main>
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
            $postid = $row[0];
            $UserName = $row[1];
            $userid = $row[2];
            $title = $row[3];
            $post = $row[4];
            $likes = $row[5];
            $date= $row[6];

            $SQL_check_if_liked = $db->prepare("SELECT * FROM likes WHERE user_id = :userid AND post_id = :postid");
            $SQL_check_if_liked->bindValue(':userid', $_SESSION['id'], SQLITE3_INTEGER);
            $SQL_check_if_liked->bindValue(':postid', $postid, SQLITE3_INTEGER);
            $liked_by_user = $SQL_check_if_liked->execute()->fetchArray() ? true : false;

            // Define the class for the like button based on whether the user has liked the post
            $likeButtonClass = $liked_by_user ? 'like-btn liked' : 'like-btn';
                
            
            echo "<div class='post'>\n";
            echo '<div class="post_header">';
            echo '<div class="post_avatar">';
            echo '<img src="https://cdn3.emoji.gg/emojis/9069-sadcat-thumbsup.png" alt="user profile">';
            echo '</div>';
            echo '<div class="post_info">';
            echo '<ul class="post_user">';
            echo "<li>{$row['1']}</li>";  // UserID
            echo '<li class="post_term">Term 1 | CST</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo "<div class='post_desc'>\n";
            echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['3']}</h1>\n"; // Title
            echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
            echo "<p>" . nl2br(htmlspecialchars($row['4'])) . "</p>";  // Post
            echo "<div class='stats'>\n";
            echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date
            // echo "<div><i class='fa-regular fa-thumbs-up'></i>{$row['5']}</div>\n";  // Likes
            echo "<button class='{$likeButtonClass}' data-postid='{$row['0']}'>"
                ."<i class='fa-regular fa-thumbs-up'></i>" 
                ."<span id='like-count-{$row['0']}'>{$row['5']}</span>"
                ."</button>\n";  // Likes button with count
            
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
        } else {
            header('Location: /../index.php');
            exit;
        }
        ?>


        <?php 
        $res = $db->query("SELECT * FROM comments WHERE PostID = $id");
        while ($row = $res->fetchArray()) {

                echo "<div class='post'>\n";
                echo '<div class="post_header">';
                echo '<div class="post_avatar">';
                echo "<img src='https://source.unsplash.com/random/200x200?sig={$row['3']}' alt='user profile'>";
                echo '</div>';
                echo '<div class="post_info">';
                echo '<ul class="post_user">';
                echo "<li>{$row['4']}</li>";  // UserID
                // echo "<li class='post_term'>{$row['7']} | {$row['8']}</li>";
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo "<div class='post_desc comment_desc'>";
                // echo "<h1>{$row['3']}</h1>\n"; // Title
                // echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
                echo "<p><i class='fa-solid fa-chevron-right'></i> {$row['2']}</p>";  // Post
                echo "</div>\n";
                echo "</div>\n";
            };

            $logged_user_id = $_SESSION['id'];
            $res = $db->query("SELECT * FROM users WHERE ID = $logged_user_id");
            $row = $res->fetchArray();
            $logged_user_name = $row['1'];
        ?>

</div>
</div>
<form action="/posts/create_comment.php" method="post">
    <div class="comment new-post">
        <label for="post">Add a new comment: </label>
        <textarea for="post" name="post" id="post"></textarea>
    </div>
    <input type="hidden" for="post_id" name="post_id" id="post_id" value="<?php echo $id; ?>">
    <input type="hidden" for="commenter_id" name="commenter_id" id="commenter_id" value="<?php echo $logged_user_id; ?>">
    <input type="hidden" for="commenter_name" name="commenter_name" id="commenter_name" value="<?php echo $logged_user_name; ?>">
    <div class='create'>
        <input type="submit" value="comment" name="comment" />
    </div>
</form>
<?php include(__DIR__ . "/../src/components/footer.php"); ?>
    <script src="../src/js/app.js"></script>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var likeButtons = document.querySelectorAll('.like-btn');
        console.log(likeButtons);
        likeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var postId = this.getAttribute('data-postid');
                var action = this.classList.contains('liked') ? 'unlike' : 'like';
                var formData = new FormData();
                formData.append('postId', postId);
                formData.append('action', action);
                fetch('../src/controllers/update_likes.php', {
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