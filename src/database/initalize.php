<?php
    // Creates posts table if does not exist
    $SQL_create_post_table = "CREATE TABLE IF NOT EXISTS posts (
        ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        UserName VARCHAR(100),
        UserID INTEGER,
        title VARCHAR(100),
        post VARCHAR(350),
        likes INTEGER,
        date DATE
    );";        
    $db->exec($SQL_create_post_table);

    // Inject sample posts if there are no entries in posts table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM posts');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $SQL_insert_post_data = "INSERT INTO posts (UserName, UserID, title, likes, date, post) VALUES
        ('Kim', 1, 'SQL Injection', 5, '2024-01-01',
        'I am having a little trouble understanding'),
        ('Carl', 2, 'Study Tips', 2, '2024-01-01', 
        'Hello, I just finished my midterms and I performed worse than I wanted to. Any tips on imporving study habits'),
        ('Rick', 3, 'Java Syntax', 12, '2024-02-23',
        'I just dont understand syntax of Java. Can someone help me'),
        ('Paul', 4, 'Divide and Conquer Algorithms', 7, date('now'),
        'What are some divide and conquer algorithms')";

        $db->exec($SQL_insert_post_data);
    }

    // Creates user table if does not exist
    $SQL_create_user_table = "CREATE TABLE IF NOT EXISTS users (
        ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        Name VARCHAR(100),
        ProgramName VARCHAR(100),
        Term VARCHAR(20)
    );";        
    $db->exec($SQL_create_user_table);

    // Inject sample users if there are no entries in users table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM users');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $SQL_insert_user_data = "INSERT INTO users (Name, ProgramName, Term) VALUES
        ('Kim', 'Computer Systems Technology', 1),
        ('Carl', 'Business Information Technology Management', 2),
        ('Rick', 'Computer Systems Technology', 2),
        ('Paul', 'Computer Systems Technology', 3)";

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


?>