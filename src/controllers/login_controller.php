<?php
define('BYPASS_AUTH', true);
require_once '../../config_session.php';
require_once '../../include_db.php';
require_once '../models/User.php';
require_once '../../utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['errors'] = "Please fill in all fields.";
        header('Location: /login.php');
        exit();
    }

    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    require_once('../models/User.php');
    
    if (User::invalidCredentials($db, $email, $password)) {
        $_SESSION['errors'] = "Invalid email or password.";
        header('Location: ../../login.php'); 
        exit();
    } else {
        $_SESSION['id'] = User::getUserId($db, $email);
        header('Location: ../../index.php'); // replace with landing page
    }
}