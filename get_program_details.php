<?php

require_once 'src/models/Program.php'; 

require_once 'include_db.php'; 

$programId = isset($_GET['programId']) ? (int) $_GET['programId'] : 0;

if ($programId > 0) {
    $programDetails = Program::getDetailsById($db, $programId);

    if ($programDetails) {
        echo json_encode($programDetails);
    } else {
        echo json_encode(['error' => 'Program details not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid program ID']);
}
?>
