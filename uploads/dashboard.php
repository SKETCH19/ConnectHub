<?php
require_once 'includes/config.php';
require_once 'includes/functions.php'; 
require_once 'includes/auth.php'; 


if (!is_logged_in()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = get_user_by_id($pdo, $user_id);
$users = get_all_users($pdo, $user_id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConnectHub - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>🚀 ConnectHub</h1>
            <nav>
                <span>Hola, <?php echo htmlspecialchars($user['username']); ?></span>
                <a href="profile.php">Perfil</a>
                <a href="logout.php">Cerrar Sesión</a>
            </nav>
        </header>

        <div class="dashboard">
            <aside class="sidebar">
                <h3>👥 Contactos</h3>
                <div class="users-list">
                    <?php foreach ($users as $contact): ?>
                        <div class="user-item" data-user-id="<?php echo $contact['id']; ?>">
                            <div class="avatar"><?php echo strtoupper(substr($contact['username'], 0, 1)); ?></div>
                            <span><?php echo htmlspecialchars($contact['username']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>

            <main class="chat-area">
                <div class="chat-header">
                    <h3>Selecciona un contacto para chatear</h3>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <!-- Los mensajes se cargan aquí via JavaScript -->
                </div>
                <div class="chat-input" style="display: none;">
                    <form id="messageForm">
                        <input type="hidden" id="receiverId" name="receiver_id">
                        <input type="text" id="messageInput" name="message" placeholder="Escribe tu mensaje..." required>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="js/messages.js"></script>
</body>
</html>