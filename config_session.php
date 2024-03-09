<?php 

ini_set(('session.use_only_cookies'), 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 3 * 60 * 60, // 3 hours
    'path' => '/',
    'domain' => '',
    'secure' => false, 
    'httponly' => true
]);

session_start();

// only check user authentication for protected pages (i.e. pages that require the user to be logged in)
if (!defined('BYPASS_AUTH')) {
    check_user_authentication();
}

if (!isset($_SESSION['last_regeneration_time'])) {
    regenerate_session_id();
} else {
    $interval = 60  * 30; // 30 minutes
    if (time() - $_SESSION['last_regeneration_time'] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id() {
    session_regenerate_id();
    $_SESSION['last_regeneration_time'] = time();
}

function check_user_authentication() {
    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['id'])) {
        header('Location: /login.php');
        exit;
    }
}