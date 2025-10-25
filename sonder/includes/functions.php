<?php
include 'config.php';

// Buscar usuarios por username
function searchUsers($query, $current_user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT id, username, full_name, profile_pic 
        FROM users 
        WHERE (username LIKE ? OR full_name LIKE ?) 
        AND id != ?
        LIMIT 10
    ");
    $stmt->execute(["%$query%", "%$query%", $current_user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Enviar solicitud de amistad
function sendFriendRequest($user_id, $friend_id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO friends (user_id, friend_id, status) VALUES (?, ?, 'pending')");
        $stmt->execute([$user_id, $friend_id]);
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Aceptar solicitud de amistad
function acceptFriendRequest($user_id, $friend_id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE friends SET status = 'accepted' WHERE user_id = ? AND friend_id = ?");
    return $stmt->execute([$friend_id, $user_id]);
}

// Bloquear usuario
function blockUser($user_id, $blocked_id) {
    global $pdo;
    // Primero verificar si ya existe una relación
    $stmt = $pdo->prepare("SELECT id FROM friends WHERE user_id = ? AND friend_id = ?");
    $stmt->execute([$user_id, $blocked_id]);
    
    if ($stmt->rowCount() > 0) {
        // Actualizar existente
        $stmt = $pdo->prepare("UPDATE friends SET status = 'blocked' WHERE user_id = ? AND friend_id = ?");
    } else {
        // Crear nueva
        $stmt = $pdo->prepare("INSERT INTO friends (user_id, friend_id, status) VALUES (?, ?, 'blocked')");
    }
    
    return $stmt->execute([$user_id, $blocked_id]);
}
?>