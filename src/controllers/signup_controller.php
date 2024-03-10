<?php
define('BYPASS_AUTH', true);
require_once '../../config_session.php';
require_once '../../include_db.php';
require_once '../../utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $program = $_POST['program'];

    require_once('../models/User.php');

    $errors = [];

    if (User::fieldsAreEmpty($username, $email, $password, $program)) {
        $errors['empty_fields'] = "Please fill in all fields.";
    } else {
        if (User::usernameExists($db, $username)) {
        $errors['username_exists'] = "Username already exists.";
        }

        if (User::emailExists($db, $email)) {
            $errors['email_exists'] = "Email already exists.";
        }

        if (User::invalidEmail($email)) {
            $errors['invalid_email'] = "Please enter a valid email address.";
        }

        $lengthErrors = User::invalidLengths($username, $password);
        $errors = array_merge($errors, $lengthErrors);
    }

    if ($errors) {
        $_SESSION['errors'] = $errors;
        header('Location: ../../signup.php');
        exit();
    } else {
        $success = User::registerUser($db, $username, $email, $password, $program);

        if (!$success) {
            $_SESSION['errors'] = ['registration_failed' => "Registration failed. Please try again."];
            header('Location: ../../signup.php');
            exit();
        } else {
            $_SESSION['success'] = "Registration successful. Please login.";
            header('Location: ../../login.php');
        }
    }
}
?>