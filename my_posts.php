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
    <title>Viewing Posts</title>
</head>
<body>
    <div class="wrap">

        <!-- Navbar -->
        <?php $title = 'Viewing Posts'?>
        <?php 
        include("config_session.php");
        include("./include_db.php");  // Connects the the db
        include("src/database/initalize.php");  // Initalizes the db
        include("src/components/header.php"); 

        function edit() {
            session_regenerate_id();
            $_SESSION['last_regeneration_time'] = time();
        }
        ?>

        <main class ='main_wrap'>
            <button class="back_btn" id='go-back'>
                <i class="fa-solid fa-angle-left"></i>
                <p>Go back</p>
            </button>

            <?php
            $id = $_SESSION['id'];
            $res = $db->query('SELECT * FROM posts WHERE UserID = ' . $id);

            while ($row = $res->fetchArray()) {
                $postid = $row['0'];

                $SQL_check_if_liked = $db->prepare("SELECT * FROM likes WHERE user_id = :userid AND post_id = :postid");
                $SQL_check_if_liked->bindValue(':userid', $id, SQLITE3_INTEGER);
                $SQL_check_if_liked->bindValue(':postid', $postid, SQLITE3_INTEGER);
                $liked_by_user = $SQL_check_if_liked->execute()->fetchArray() ? true : false;

                // Define the class for the like button based on whether the user has liked the post
                $likeButtonClass = $liked_by_user ? 'like-btn liked' : 'like-btn';

                echo "<div class='post post_desc'>\n";
                    echo "<h1><i class='fa-solid fa-chevron-right'></i>{$row['3']}</h1>\n"; // Title
                    echo "<b>{$row['7']} | {$row['8']}</b>";  // Program | course
                    echo "<p>{$row['4']}</p>";  // Post
                    echo "<div class='stats'>\n";
                        echo "<div><i class='fa-regular fa-clock'></i>{$row['6']}</div>\n";  // Date
                        
                        echo "<div><button class='{$likeButtonClass}' data-postid='{$row['0']}'>"
                            ."<i class='fa-regular fa-thumbs-up'></i>{$row['5']}\n"
                            ."</button></div>\n";  // Likes button with count

                        echo "<div><a href='posts/delete_post.php?id={$row['0']}'><i class='fa-regular fa-trash-can'></i>Delete</a></div>\n";  // Delete
                    echo "</div>\n";
                echo "</div>\n";
            };
            ?>
        </main>

        <?php include("src/components/footer.php"); ?>
    </div>

    <script src="./src/js/app.js"></script>
</body>
</html>


<script>
    document.getElementById("go-back").addEventListener("click", () => {
        history.back();
    });

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