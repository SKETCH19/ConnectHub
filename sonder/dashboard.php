<?php
include 'includes/auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$userInfo = getUserInfo($_SESSION['user_id']);

// Obtener amigos del usuario
function getUserFriends($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT u.id, u.username, u.full_name, u.profile_pic, f.status 
        FROM friends f 
        JOIN users u ON u.id = f.friend_id 
        WHERE f.user_id = ? AND f.status = 'accepted'
        UNION
        SELECT u.id, u.username, u.full_name, u.profile_pic, f.status 
        FROM friends f 
        JOIN users u ON u.id = f.user_id 
        WHERE f.friend_id = ? AND f.status = 'accepted'
    ");
    $stmt->execute([$user_id, $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener solicitudes pendientes
function getPendingRequests($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT u.id, u.username, u.full_name, u.profile_pic, f.created_at 
        FROM friends f 
        JOIN users u ON u.id = f.user_id 
        WHERE f.friend_id = ? AND f.status = 'pending'
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener usuarios bloqueados
function getBlockedUsers($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT u.id, u.username, u.full_name, u.profile_pic 
        FROM friends f 
        JOIN users u ON u.id = f.friend_id 
        WHERE f.user_id = ? AND f.status = 'blocked'
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener contactos destacados
function getFeaturedContacts($user_id) {
    global $pdo;
    // En una implementación real, tendrías una tabla para destacados
    // Por ahora devolvemos algunos amigos como ejemplo
    return getUserFriends($user_id);
}

$friends = getUserFriends($_SESSION['user_id']);
$pending_requests = getPendingRequests($_SESSION['user_id']);
$blocked_users = getBlockedUsers($_SESSION['user_id']);
$featured_contacts = getFeaturedContacts($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonder - Mensajería</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard">
        <!-- Menú lateral -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="user-info">
                    <img src="uploads/<?php echo $userInfo['profile_pic']; ?>" alt="Avatar" class="user-avatar" onerror="this.src='https://via.placeholder.com/40'">
                    <span class="username"><?php echo htmlspecialchars($userInfo['username']); ?></span>
                </div>
                <button class="menu-toggle">☰</button>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item active" data-section="messages">
                    <span class="menu-icon">💬</span>
                    <span>Mensajes</span>
                </div>
                <div class="menu-item" data-section="friends">
                    <span class="menu-icon">👥</span>
                    <span>Amigos</span>
                    <?php if (count($pending_requests) > 0): ?>
                        <span class="notification-badge"><?php echo count($pending_requests); ?></span>
                    <?php endif; ?>
                </div>
                <div class="menu-item" data-section="search">
                    <span class="menu-icon">🔍</span>
                    <span>Buscar amigos</span>
                </div>
                <div class="menu-item" data-section="featured">
                    <span class="menu-icon">⭐</span>
                    <span>Destacados</span>
                </div>
                <div class="menu-item" data-section="profile">
                    <span class="menu-icon">👤</span>
                    <span>Perfil</span>
                </div>
            </div>
        </div>
        
        <!-- Área de contenido principal - Mensajes -->
        <div class="chat-area" id="messages-section">
            <div class="chat-header">
                <div class="chat-user">
                    <img src="https://via.placeholder.com/45" alt="Usuario" class="chat-user-avatar">
                    <div class="chat-user-info">
                        <h3>Bienvenido a Sonder</h3>
                        <p>Selecciona una conversación</p>
                    </div>
                </div>
                <div class="chat-actions">
                    <button title="Nuevo chat" id="new-chat-btn">✚</button>
                </div>
            </div>
            
            <div class="messages-container">
                <div class="welcome-message">
                    <h3>💫 Bienvenido a Sonder</h3>
                    <p>Tu espacio para conexiones significativas</p>
                    <p>Selecciona un chat de la lista o inicia una nueva conversación</p>
                </div>
            </div>
            
            <div class="message-input-container" style="display: none;">
                <input type="text" class="message-input" placeholder="Escribe un mensaje...">
                <button class="send-button">➤</button>
            </div>
        </div>
        
        <!-- Sección de Amigos -->
        <div class="content-area" id="friends-section" style="display: none;">
            <div class="section-header">
                <h2>👥 Mis Amigos</h2>
                <div class="section-tabs">
                    <button class="tab-btn active" data-tab="friends-list">Amigos</button>
                    <button class="tab-btn" data-tab="pending-requests">Solicitudes 
                        <?php if (count($pending_requests) > 0): ?>
                            <span class="tab-badge"><?php echo count($pending_requests); ?></span>
                        <?php endif; ?>
                    </button>
                    <button class="tab-btn" data-tab="blocked-users">Bloqueados</button>
                </div>
            </div>
            
            <div class="tab-content active" id="friends-list">
                <?php if (count($friends) > 0): ?>
                    <div class="friends-list">
                        <?php foreach ($friends as $friend): ?>
                            <div class="friend-item" data-user-id="<?php echo $friend['id']; ?>">
                                <img src="uploads/<?php echo $friend['profile_pic']; ?>" alt="<?php echo htmlspecialchars($friend['username']); ?>" class="friend-avatar" onerror="this.src='https://via.placeholder.com/50'">
                                <div class="friend-info">
                                    <div class="friend-name"><?php echo htmlspecialchars($friend['full_name']); ?></div>
                                    <div class="friend-username">@<?php echo htmlspecialchars($friend['username']); ?></div>
                                </div>
                                <div class="friend-actions">
                                    <button class="friend-action chat-with-friend" title="Chatear">💬</button>
                                    <button class="friend-action block-friend" title="Bloquear">🚫</button>
                                    <button class="friend-action remove-friend" title="Eliminar">🗑️</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">👥</div>
                        <h3>Aún no tienes amigos</h3>
                        <p>Busca usuarios y envíales solicitudes para comenzar a chatear</p>
                        <button class="btn btn-primary" onclick="showSection('search')">Buscar amigos</button>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="tab-content" id="pending-requests">
                <?php if (count($pending_requests) > 0): ?>
                    <div class="requests-list">
                        <?php foreach ($pending_requests as $request): ?>
                            <div class="request-item" data-user-id="<?php echo $request['id']; ?>">
                                <img src="uploads/<?php echo $request['profile_pic']; ?>" alt="<?php echo htmlspecialchars($request['username']); ?>" class="request-avatar" onerror="this.src='https://via.placeholder.com/50'">
                                <div class="request-info">
                                    <div class="request-name"><?php echo htmlspecialchars($request['full_name']); ?></div>
                                    <div class="request-username">@<?php echo htmlspecialchars($request['username']); ?></div>
                                    <div class="request-time">Hace <?php echo time_elapsed_string($request['created_at']); ?></div>
                                </div>
                                <div class="request-actions">
                                    <button class="btn btn-primary accept-request">Aceptar</button>
                                    <button class="btn btn-secondary decline-request">Rechazar</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">📨</div>
                        <h3>No hay solicitudes pendientes</h3>
                        <p>Las solicitudes de amistad aparecerán aquí</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="tab-content" id="blocked-users">
                <?php if (count($blocked_users) > 0): ?>
                    <div class="blocked-list">
                        <?php foreach ($blocked_users as $blocked): ?>
                            <div class="blocked-item" data-user-id="<?php echo $blocked['id']; ?>">
                                <img src="uploads/<?php echo $blocked['profile_pic']; ?>" alt="<?php echo htmlspecialchars($blocked['username']); ?>" class="blocked-avatar" onerror="this.src='https://via.placeholder.com/50'">
                                <div class="blocked-info">
                                    <div class="blocked-name"><?php echo htmlspecialchars($blocked['full_name']); ?></div>
                                    <div class="blocked-username">@<?php echo htmlspecialchars($blocked['username']); ?></div>
                                </div>
                                <div class="blocked-actions">
                                    <button class="btn btn-primary unblock-user">Desbloquear</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">🚫</div>
                        <h3>No hay usuarios bloqueados</h3>
                        <p>Los usuarios que bloquees aparecerán aquí</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Sección de Búsqueda -->
        <div class="content-area" id="search-section" style="display: none;">
            <div class="section-header">
                <h2>🔍 Buscar Amigos</h2>
            </div>
            
            <div class="search-container">
                <input type="text" class="search-input" id="user-search" placeholder="Buscar por nombre de usuario...">
                <button class="btn btn-primary" id="search-btn">Buscar</button>
            </div>
            
            <div class="search-results" id="search-results">
                <div class="empty-state">
                    <div class="empty-icon">🔍</div>
                    <h3>Busca usuarios</h3>
                    <p>Ingresa un nombre de usuario para buscar</p>
                </div>
            </div>
        </div>
        
        <!-- Sección de Destacados -->
        <div class="content-area" id="featured-section" style="display: none;">
            <div class="section-header">
                <h2>⭐ Contactos Destacados</h2>
            </div>
            
            <?php if (count($featured_contacts) > 0): ?>
                <div class="featured-list">
                    <?php foreach ($featured_contacts as $featured): ?>
                        <div class="featured-item" data-user-id="<?php echo $featured['id']; ?>">
                            <div class="featured-badge">⭐</div>
                            <img src="uploads/<?php echo $featured['profile_pic']; ?>" alt="<?php echo htmlspecialchars($featured['username']); ?>" class="featured-avatar" onerror="this.src='https://via.placeholder.com/60'">
                            <div class="featured-info">
                                <div class="featured-name"><?php echo htmlspecialchars($featured['full_name']); ?></div>
                                <div class="featured-username">@<?php echo htmlspecialchars($featured['username']); ?></div>
                            </div>
                            <div class="featured-actions">
                                <button class="featured-action chat-featured" title="Chatear">💬</button>
                                <button class="featured-action remove-featured" title="Quitar de destacados">⭐</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">⭐</div>
                    <h3>No hay contactos destacados</h3>
                    <p>Agrega contactos a destacados para verlos aquí</p>
                    <button class="btn btn-primary" onclick="showSection('friends')">Ver amigos</button>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Sección de Perfil -->
        <div class="content-area" id="profile-section" style="display: none;">
            <div class="section-header">
                <h2>👤 Mi Perfil</h2>
            </div>
            
            <div class="profile-container">
                <div class="profile-header">
                    <div class="avatar-upload">
                        <img src="uploads/<?php echo $userInfo['profile_pic']; ?>" alt="Avatar" class="profile-avatar" id="profile-avatar" onerror="this.src='https://via.placeholder.com/100'">
                        <input type="file" id="avatar-input" accept="image/*" style="display: none;">
                        <button class="btn btn-secondary" onclick="document.getElementById('avatar-input').click()">Cambiar foto</button>
                    </div>
                    <div class="profile-info">
                        <h2 id="profile-display-name"><?php echo htmlspecialchars($userInfo['full_name']); ?></h2>
                        <p id="profile-username">@<?php echo htmlspecialchars($userInfo['username']); ?></p>
                        <p class="profile-join-date">Miembro desde <?php echo date('F Y', strtotime($userInfo['created_at'])); ?></p>
                    </div>
                </div>
                
                <div class="profile-form">
                    <h3>Información Personal</h3>
                    <form id="profile-form">
                        <div class="form-group">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="full_name" class="form-input" value="<?php echo htmlspecialchars($userInfo['full_name']); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" name="username" class="form-input" value="<?php echo htmlspecialchars($userInfo['username']); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-input" value="<?php echo htmlspecialchars($userInfo['email']); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">País</label>
                            <select name="country" class="form-select">
                                <option value="ES" <?php echo $userInfo['country'] == 'ES' ? 'selected' : ''; ?>>España</option>
                                <option value="MX" <?php echo $userInfo['country'] == 'MX' ? 'selected' : ''; ?>>México</option>
                                <option value="AR" <?php echo $userInfo['country'] == 'AR' ? 'selected' : ''; ?>>Argentina</option>
                                <option value="CO" <?php echo $userInfo['country'] == 'CO' ? 'selected' : ''; ?>>Colombia</option>
                                <option value="US" <?php echo $userInfo['country'] == 'US' ? 'selected' : ''; ?>>Estados Unidos</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" name="phone" class="form-input" value="<?php echo htmlspecialchars($userInfo['phone']); ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
                
                <div class="profile-security">
                    <h3>Seguridad</h3>
                    <button class="btn btn-secondary" id="change-password-btn">Cambiar contraseña</button>
                </div>
                
                <div class="profile-danger">
                    <h3>Zona de peligro</h3>
                    <button class="btn btn-danger" id="delete-account-btn">Eliminar cuenta</button>
                    <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para cambiar contraseña -->
    <div class="modal" id="password-modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Cambiar Contraseña</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form id="password-form">
                <div class="form-group">
                    <label class="form-label">Contraseña actual</label>
                    <input type="password" name="current_password" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nueva contraseña</label>
                    <input type="password" name="new_password" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmar nueva contraseña</label>
                    <input type="password" name="confirm_password" class="form-input" required>
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    <button type="button" class="btn btn-secondary modal-cancel">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modal para eliminar cuenta -->
    <div class="modal" id="delete-modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Eliminar Cuenta</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                <p>Todos tus mensajes, amigos y datos se perderán permanentemente.</p>
                <form id="delete-form">
                    <div class="form-group">
                        <label class="form-label">Ingresa tu contraseña para confirmar</label>
                        <input type="password" name="confirm_password" class="form-input" required>
                    </div>
                    <div class="modal-actions">
                        <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
                        <button type="button" class="btn btn-secondary modal-cancel">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>

<?php
// Función auxiliar para mostrar tiempo transcurrido - VERSIÓN CORREGIDA
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    // Calcular semanas manualmente
    $weeks = floor($diff->d / 7);
    $days = $diff->d - $weeks * 7;

    $string = array(
        'y' => 'año',
        'm' => 'mes',
        'd' => 'día',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    
    // Agregar semanas si existen
    if ($weeks > 0) {
        $string['w'] = 'semana';
    }
    
    $result = array();
    foreach ($string as $k => &$v) {
        if ($k === 'w') {
            $value = $weeks;
        } elseif ($k === 'd') {
            $value = $days;
        } else {
            $value = $diff->$k;
        }
        
        if ($value > 0) {
            $v = $value . ' ' . $v . ($value > 1 ? 's' : '');
            $result[] = $v;
        }
    }

    if (!$full) $result = array_slice($result, 0, 1);
    return $result ? implode(', ', $result) . '' : 'justo ahora';
}
?>