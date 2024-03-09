<?php
    // Creates posts table if does not exist
    $SQL_create_table = "CREATE TABLE IF NOT EXISTS posts (
        ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        UserName VARCHAR(100),
        title VARCHAR(100),
        post VARCHAR(350),
        likes INTEGER,
        date DATE
    );";        
    $db->exec($SQL_create_table);

    // Inject sample posts if there are no entries in posts table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM posts');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $SQL_insert_data = "INSERT INTO posts (UserName, title, likes, date, post) VALUES
        ('Kim', 'SQL Injection', 5, '2024-01-01',
        'I am having a little trouble understanding'),
        ('Carl', 'Study Tips', 2, '2024-01-01', 
        'Hello, I just finished my midterms and I performed worse than I wanted to. Any tips on imporving study habits'),
        ('Rick', 'Java Syntax', 12, '2024-02-23',
        'I just dont understand syntax of Java. Can someone help me'),
        ('Paul', 'Divide and Conquer Algorithms', 7, date('now'),
        'What are some divide and conquer algorithms')";

        $db->exec($SQL_insert_data);
    }
    
?>