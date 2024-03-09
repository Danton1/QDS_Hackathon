<?php
$home_location = '/index.php';
$post_location = '/posts/create_post.php';
$user_location = '/profile.php';
?>

<!-- HTML snippet that is inserted when the navbarplaceholder is called upon -->
<header class="header">
  <a href="./index.php" class="logo">
    <img src="./src/imgs/icon.png" class="logo-img" alt="">
    <span>School</span>Board
  </a>
  <label class="hamburger">
    <input type="checkbox" id="menu-btn">
    <svg viewBox="0 0 32 32">
      <path class="line line-top-bottom" d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"></path>
      <path class="line" d="M7 16 27 16"></path>
    </svg>
  </label>
  <nav class="navbar">
      <a href="./index.php#home" class="mobile-only"><i class="fa-solid fa-house-chimney"></i> Home</a>
      <a href="#"><i class="fa-solid fa-list"></i> My Posts</a>
      <a href="#"><i class="fa-solid fa-spell-check"></i> Posts</a>
      <a href="./login.php"><i class="fa-solid fa-user-plus"></i> Login</a>
  </nav>
</header>

<!-- <header class="header">
    <h3 class="page_title">General</h3>
    <i class="fa-solid fa-bars"></i>
</header> -->
<!-- End of HTML snippet that is inserted when the navbarplaceholder is called upon -->