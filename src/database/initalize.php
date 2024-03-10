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

    // Creates courses table if does not exist
    $SQL_create_courses_Table = "CREATE TABLE IF NOT EXISTS courses (
        CourseID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        CourseNum VARCHAR(50),
        CourseName VARCHAR(100),
        Program VARCHAR(100),
        Term INTEGER
    )";
    $db->exec($SQL_create_courses_Table);

    // Inject sample courses if there are no entries in courses table
    $stmt = $db->prepare('SELECT COUNT(*) as cnt FROM courses');
    $res = $stmt->execute();
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $count = $row['cnt'];

    if ($count == 0) {
        $SQL_insert_courses_data = "INSERT INTO courses (CourseNum, CourseName, Program, Term) VALUES
        ('COMM 1116', 'Business Communications 1', 'Computer Systems Technology', 1),
        ('COMP 1100', 'CST Program Fundamentals', 'Computer Systems Technology', 1),
        ('COMP 1113', 'Applied Mathematics', 'Computer Systems Technology', 1),
        ('COMP 1510', 'Programming Methods', 'Computer Systems Technology', 1),
        ('COMP 1537', 'Web Development 1', 'Computer Systems Technology', 1),
        ('COMP 1712', 'Business Analysis and System Design', 'Computer Systems Technology', 1),
        ('COMP 1800', 'Projects 1', 'Computer Systems Technology', 1),
        ('COMP 2537', 'Web Development 2', 'Computer Systems Technology', 1),
        ('COMP 2800', 'Project 2', 'Computer Systems Technology', 1),
        ('COMM 2216', 'Business Communications 2', 'Computer Systems Technology', 2),
        ('COMP 2121', 'Discrete Mathematics', 'Computer Systems Technology', 2),
        ('COMP 2510', 'Procedural Programming', 'Computer Systems Technology', 2),
        ('COMP 2522', 'Object Oridented Programming 1', 'Computer Systems Technology', 2),
        ('COMP 2714', 'Relational Database Systems', 'Computer Systems Technology', 2),
        ('COMP 2721', 'Computer Organization/Architecture', 'Computer Systems Technology', 2),
        ('COMP 3522', 'Object Oriented Programming 2', 'Computer Systems Technology', 3),
        ('COMP 3717', 'Mobile Development', 'Computer Systems Technology', 3),
        ('COMP 3721', 'Data Communications', 'Computer Systems Technology', 3),
        ('COMP 3760', 'Algorithm Analysis and Design', 'Computer Systems Technology', 3),
        ('MATH 3042', 'Applied Probability and Statistics', 'Computer Systems Technology', 3),
        ('COMP 4537', 'Internet Software Architecture', 'Computer Systems Technology', 4),
        ('COMP 4736', 'Introduction to Operating Systems', 'Computer Systems Technology', 4),
        ('LIBS 7102', 'Ethics for Computing Professionals', 'Computer Systems Technology', 4),
            -- business:
        ('BSYS 1000', 'Business Information Systems', 'Business Information Technology Management', 1),
        ('COMM 1100', 'Business Communication 1', 'Business Information Technology Management', 1),
        ('ECON 2100', 'Microeconomics', 'Business Information Technology Management', 1),
        ('MKTG 1102', 'Essentials of Marketing', 'Business Information Technology Management', 1),
        ('OPMT 1103', 'Introduction to Operations Management', 'Business Information Technology Management', 1),
        ('OPMT 1110', 'Business Mathematics', 'Business Information Technology Management', 1),
        ('BSYS 2000', 'Applied Data Analytics in Excel', 'Business Information Technology Management', 2),
        ('BSYS 2065', 'Business Systems Programming*', 'Business Information Technology Management', 2),
        ('BUSA 2100', 'Principles of Management*', 'Business Information Technology Management', 2),
        ('COMM 2200', 'Business Communication 2', 'Business Information Technology Management', 2),
        ('ECON 2200', 'Macroeconomics', 'Business Information Technology Management', 2),
        ('FMGT 2152', 'Accounting for Management', 'Business Information Technology Management', 2),
        ('OPMT 1130', 'Business Statistics', 'Business Information Technology Management', 2),
        ('OPMT 1174', 'Project Management*', 'Business Information Technology Management', 2),
        ('ORGB 1100', 'Organizational Behaviour*', 'Business Information Technology Management', 2),
        ('BSYS 3000', 'Cloud Business Development 1', 'Business Information Technology Management', 3),
        ('BSYS 3105', 'Information Technology 1', 'Business Information Technology Management', 3),
        ('BSYS 3205', 'Business Intelligence 1', 'Business Information Technology Management', 3),
        ('BSYS 3355', 'Management Information Systems', 'Business Information Technology Management', 3),
        ('BUSA 4850', 'Consulting Skills and Problem Solving*', 'Business Information Technology Management', 3),
        ('FMGT 3221', 'Management Accounting Administration', 'Business Information Technology Management', 3),
        ('OPMT 2172', 'Applied Management Engineering', 'Business Information Technology Management', 3),
        ('OPMT 3301', 'Quantitative Methods for Business', 'Business Information Technology Management', 3),
        ('BLAW 3600', 'Computers and the Law', 'Business Information Technology Management', 4),
        ('BSYS 4000', 'Cloud Business Development 2', 'Business Information Technology Management', 4),
        ('BSYS 4075', 'Integrated Business Processes', 'Business Information Technology Management', 4),
        ('BSYS 4205', 'Business Intelligence 2*', 'Business Information Technology Management', 4),
        ('BSYS 4905', 'Directed Studies*', 'Business Information Technology Management', 4),
        ('BUSA 4800', 'Management Policy', 'Business Information Technology Management', 4),
        ('FMGT 4530', 'Enterprise Finance', 'Business Information Technology Management', 4),
        ('OPMT 4170', 'Applied Project Management*', 'Business Information Technology Management', 4);
        $db->exec($SQL_insert_courses_data);
    }

    $SQL_create_likes_table = "CREATE TABLE IF NOT EXISTS likes (
        user_id INTEGER NOT NULL,
        post_id INTEGER NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (user_id, post_id),
        FOREIGN KEY (user_id) REFERENCES users(ID) ON DELETE CASCADE,
        FOREIGN KEY (post_id) REFERENCES posts(ID) ON DELETE CASCADE
    );";
    $db->exec($SQL_create_likes_table);
?>