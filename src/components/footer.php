<?php
$home_location = '/index.php';
$post_location = '/posts/create_post.php';
$user_location = '/profile.php';
?>

<footer class="footer">
    <i class="fa-solid fa-arrows-rotate" onclick="window.location.href='<?php echo $home_location ?>'"></i>
    <i class="fa-solid fa-circle-plus" onclick="window.location.href='<?php echo $post_location ?>'"></i>
    <i class="fa-solid fa-circle-user" onclick="window.location.href='<?php echo $user_location ?>'"></i> 
</footer>