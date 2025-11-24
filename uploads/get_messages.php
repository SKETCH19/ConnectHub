<?php
require_once 'includes/config.php';
require_once 'includes/functions.php'; 
require_once 'includes/auth.php'; 


header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode([]);
    exit;
}

if (isset($_GET['receiver_id'])) {
    $user1_id = $_SESSION['user_id'];
    $user2_id = intval($_GET['receiver_id']);
    
    $messages = get_messages($pdo, $user1_id, $user2_id);
    echo json_encode($messages);
} else {
    echo json_encode([]);
}
?>