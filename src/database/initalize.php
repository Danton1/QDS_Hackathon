<?php
    // Creates posts table if does not exist
    $SQL_create_post_table = "CREATE TABLE IF NOT EXISTS posts (
        ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        UserName VARCHAR(100),
        UserID INTEGER,
        title VARCHAR(100),
        post VARCHAR(350),
        likes INTEGER,
        date DATE,
        program VARCHAR(100),
        course VARCHAR(100)
    );";        
    $db->exec($SQL_create_post_table);

    // Inject sample posts if there are no entries in posts table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM posts');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $SQL_insert_post_data = "INSERT INTO posts (UserName, UserID, title, likes, date, program, course, post) VALUES
        ('Kim', 1, 'SQL Injection', 5, '2024-01-01', 'Computer Systems Techonology', 'COMP 2537',
        'I am having a little trouble understanding'),
        ('Carl', 2, 'Study Tips', 2, '2024-01-01', 'Business Information Technology Management', 'General',
        'Hello, I just finished my midterms and I performed worse than I wanted to. Any tips on imporving study habits'),
        ('Rick', 3, 'Java Syntax', 12, '2024-02-23', 'Computer Systems Techonology', 'COMP 2522',
        'I just dont understand syntax of Java. Can someone help me'),
        ('Paul', 4, 'Divide and Conquer Algorithms', 7, date('now'), 'Computer Systems Techonology', 'COMP 3760',
        'What are some divide and conquer algorithms')";

        $db->exec($SQL_insert_post_data);
    }

    // Creates user table if does not exist
    $SQL_create_user_table = "CREATE TABLE IF NOT EXISTS users (
        ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        Name VARCHAR(100),
        Email VARCHAR(100),
        Password VARCHAR(100),
        ProgramName VARCHAR(100),
        Term VARCHAR(20),
        Foreign Key (ProgramName) References programs(ProgramName)
    );";        
    $db->exec($SQL_create_user_table);

    // Inject sample users if there are no entries in users table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM users');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $hashedPasswordKim = password_hash('Kim', PASSWORD_DEFAULT);
        $hashedPasswordCarl = password_hash('Carl', PASSWORD_DEFAULT);
        $hashedPasswordRick = password_hash('Rick', PASSWORD_DEFAULT);
        $hashedPasswordPaul = password_hash('Paul', PASSWORD_DEFAULT);
    
        $SQL_insert_user_data = "INSERT INTO users (Name, Email, Password, ProgramName, Term) VALUES
        ('Kim', 'Kim@gmail.com', '$hashedPasswordKim', 'Computer Systems Technology', 1),
        ('Carl', 'Carl@gmail.com', '$hashedPasswordCarl', 'Business Information Technology Management', 2),
        ('Rick', 'Rick@gmail.com', '$hashedPasswordRick', 'Computer Systems Technology', 2),
        ('Paul', 'Paul@gmail.com', '$hashedPasswordPaul', 'Computer Systems Technology', 3)";
    
        $db->exec($SQL_insert_user_data);
    }

    // Creates comments table if does not exist
    $SQL_create_comments_table = "CREATE TABLE IF NOT EXISTS comments (
        ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        postID INTEGER,
        comment VARCHAR(100),
        commenterID INTEGER,
        commenterName VARCHAR(20)
    );";        
    $db->exec($SQL_create_comments_table);
    
    // Inject sample comments if there are no entries in comments table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM comments');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $SQL_insert_comments_data = "INSERT INTO comments (postID, comment, commenterID, commenterName) VALUES
        (2, 'pomodoro has really helped me', 3, 'Rick'),
        (4, 'Merge sort is a popular sorting divide and conquer algo', 1, 'Kim')";

        $db->exec($SQL_insert_comments_data);
    }

    // Creates programs table if does not exist
    $SQL_create_programs_Table = "CREATE TABLE IF NOT EXISTS programs (
        ProgramID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        ProgramName VARCHAR(100),
        NumTerms INTEGER,
        Coop Boolean DEFAULT 0
    )";
    $db->exec($SQL_create_programs_Table);

    // Inject sample programs if there are no entries in programs table
    $results = $db->query("SELECT COUNT(*) as count FROM programs");
    $row = $results->fetchArray();
    if ($row['count'] == 0) {
        $db->exec("
        INSERT INTO programs (ProgramName, NumTerms, Coop) VALUES 
        ('Business Information Technology Management', 4, 0),
        ('Computer Systems Technology', 4, 1)
        ");
    }
?>