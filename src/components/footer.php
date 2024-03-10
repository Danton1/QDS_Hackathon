<?php
$home_location = '/index.php';
$post_location = '/index.php#new_post';
$user_location = '/profile.php';
?>

<footer class="footer">
    <nav class="navbar">
        <a><i class="fa-solid fa-arrows-rotate" onclick="window.location.href='<?php echo $home_location ?>'"></i></a>
        <a><i class="fa-solid fa-circle-plus" onclick="window.location.href='<?php echo $post_location ?>'"></i></a>
        <a><i class="fa-solid fa-circle-user" onclick="window.location.href='<?php echo $user_location ?>'"></i></a>
    </nav>
</footer>