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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    
    try {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $user_id]);
        
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Perfil actualizado correctamente";
        header("Location: profile.php");
        exit;
    } catch(PDOException $e) {
        $error = "Error al actualizar: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConnectHub - Perfil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>🚀 ConnectHub</h1>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Cerrar Sesión</a>
            </nav>
        </header>

        <div class="profile-container">
            <h2>Mi Perfil</h2>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="profile-info">
                <div class="avatar-large">
                    <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                </div>
                
                <form method="POST" class="profile-form">
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Miembro desde:</label>
                        <p><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></p>
                    </div>
                    
                    <button type="submit" name="update_profile" class="btn btn-primary">Actualizar Perfil</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>