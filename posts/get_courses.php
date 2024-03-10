<?php
// connect to the database
include("../include_db.php");

// get the term from the request parameters
$term = $_GET['term'];

// prepare the SQL query
$stmt = $db->prepare('SELECT * FROM courses WHERE Term = :term');
$stmt->bindValue(':term', $term, SQLITE3_INTEGER);

// execute the query and fetch the results
$result = $stmt->execute();
$courses = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $courses[] = $row;
}

// encode the results to JSON format
$json = json_encode($courses);

// print the JSON
echo $json;
?>