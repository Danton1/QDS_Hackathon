<?php
    Class User {

        public static function registerUser($db, $username, $email, $password, $program, $term) {
            $stmt = $db->prepare('INSERT INTO users (Name, Email, Password, ProgramName, Term) VALUES (:username, :email, :password, :program, :term)');
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
            $stmt->bindValue(':program', $program, SQLITE3_TEXT);
            $stmt->bindValue(':term', $term, SQLITE3_TEXT);
            
            return $stmt->execute() ? true : false;
        }
        
        public static function fieldsAreEmpty($username, $email, $password, $program) {
            if (empty($username) || empty($email) || empty($password) || empty($program)) {
                return true;
            }
            return false;
        }

        public static function usernameExists($db, $username) {
            $stmt = $db->prepare('SELECT * FROM users WHERE Name = :username');
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $result = $stmt->execute();

            if ($result->fetchArray()) {
                return true;
            }
            return false;
        }

        public static function emailExists($db, $email) {
            $stmt = $db->prepare('SELECT * FROM users WHERE Email = :email');
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $result = $stmt->execute();

            if ($result->fetchArray()) {
                return true;
            }
            return false;
        }

        public static function invalidLengths($username, $password) {
            $errors = [];
            if (strlen($username) < 3 || strlen($username) > 20) {
                $errors['invalid_username'] = "Username must be between 3 and 20 characters.";
            }
            if (strlen($password) < 6 || strlen($password) > 20) {
                $errors['invalid_password'] = "Password must be between 6 and 20 characters.";
            }
            return $errors;
        }

        public static function invalidEmail($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }

        public static function invalidCredentials($db, $email, $password) {
            $stmt = $db->prepare('SELECT * FROM users WHERE Email = :email');
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $result = $stmt->execute();
            $user = $result->fetchArray();

            if ($user && password_verify($password, $user['Password'])) {
                return false;
            }
            return true;
        }

        public static function getUserId($db, $email) {
            $stmt = $db->prepare('SELECT ID FROM users WHERE Email = :email');
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $result = $stmt->execute();
            $user = $result->fetchArray();

            return $user['ID'];
        }
    }
?>