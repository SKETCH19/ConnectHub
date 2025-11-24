<?php
require_once 'includes/config.php';
require_once 'includes/functions.php'; 
require_once 'includes/auth.php'; 


header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode(['success' => false, 'error' => 'No autenticado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = intval($_POST['receiver_id']);
    $message = trim($_POST['message']);
    
    if (empty($message)) {
        echo json_encode(['success' => false, 'error' => 'Mensaje vacío']);
        exit;
    }
    
    if (send_message($pdo, $sender_id, $receiver_id, $message)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al enviar mensaje']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>