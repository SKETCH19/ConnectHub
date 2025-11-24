<?php
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_user_by_id($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_all_users($pdo, $exclude_id = null) {
    if ($exclude_id) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id != ? ORDER BY username");
        $stmt->execute([$exclude_id]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users ORDER BY username");
        $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_messages($pdo, $user1_id, $user2_id) {
    $stmt = $pdo->prepare("
        SELECT m.*, u.username as sender_name 
        FROM messages m 
        JOIN users u ON m.sender_id = u.id 
        WHERE (sender_id = ? AND receiver_id = ?) 
        OR (sender_id = ? AND receiver_id = ?) 
        ORDER BY created_at ASC
    ");
    $stmt->execute([$user1_id, $user2_id, $user2_id, $user1_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function send_message($pdo, $sender_id, $receiver_id, $message) {
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    return $stmt->execute([$sender_id, $receiver_id, $message]);
}
?>