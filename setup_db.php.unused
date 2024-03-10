<?php

require_once 'include_db.php';

$db->exec("
CREATE TABLE IF NOT EXISTS users (
    ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Password VARCHAR(100),
    Term VARCHAR(20),
    Program INTEGER,
    FOREIGN KEY (Program) REFERENCES programs(ProgramID)
)");

$db->exec("
CREATE TABLE IF NOT EXISTS programs (
    ProgramID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    ProgramName VARCHAR(100),
    NumTerms INTEGER
)");

$results = $db->query("SELECT COUNT(*) as count FROM programs");
$row = $results->fetchArray();
if ($row['count'] == 0) {
    $db->exec("
    INSERT INTO programs (ProgramName, NumTerms) VALUES 
    ('Business Information Technology Management', 4),
    ('Computer Systems Technology', 4)
    ");
}
?>