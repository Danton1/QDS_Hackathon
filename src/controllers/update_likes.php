<?php
header('Content-Type: application/json');
require_once('../../config_session.php');
require_once('../../include_db.php');

$userId = $_SESSION['id'] ?? null;
$postId = $_POST['postId'] ?? null;
$action = $_POST['action'] ?? '';

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'User ID not found in session.']);
    exit;
}

if ($postId && ($action === 'like' || $action === 'unlike')) {
    $db->exec('BEGIN');
    try {
        if ($action === 'like') {
            $insertStmt = $db->prepare("INSERT INTO likes (user_id, post_id) VALUES (:userId, :postId) ON CONFLICT (user_id, post_id) DO NOTHING");
            $insertStmt->bindValue(':userId', $userId, SQLITE3_INTEGER);
            $insertStmt->bindValue(':postId', $postId, SQLITE3_INTEGER);
            $insertStmt->execute();

            $updateStmt = $db->prepare("UPDATE posts SET likes = likes + 1 WHERE ID = :postId");
        } else {
            $deleteStmt = $db->prepare("DELETE FROM likes WHERE user_id = :userId AND post_id = :postId");
            $deleteStmt->bindValue(':userId', $userId, SQLITE3_INTEGER);
            $deleteStmt->bindValue(':postId', $postId, SQLITE3_INTEGER);
            $deleteStmt->execute();

            $updateStmt = $db->prepare("UPDATE posts SET likes = likes - 1 WHERE ID = :postId");
        }

        $updateStmt->bindValue(':postId', $postId, SQLITE3_INTEGER);
        $updateStmt->execute();

        $selectStmt = $db->prepare("SELECT likes FROM posts WHERE ID = :postId");
        $selectStmt->bindValue(':postId', $postId, SQLITE3_INTEGER);
        $result = $selectStmt->execute();
        $likeCount = $result->fetchArray(SQLITE3_ASSOC)['likes'];

        $db->exec('COMMIT');
        echo json_encode(['success' => true, 'likes' => $likeCount]);
    } catch (Exception $e) {
        $db->exec('ROLLBACK');
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
