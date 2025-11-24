<?php
require_once 'includes/config.php';
require_once 'includes/functions.php'; 
require_once 'includes/auth.php'; 

if (is_logged_in()) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConnectHub - Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="auth-form">
            <h1>🚀 ConnectHub</h1>
            <h2>Crear Cuenta</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <input type="hidden" name="register" value="1">
                
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="password-toggle" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">👁️</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña:</label>
                    <div style="position: relative;">
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="password-toggle" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">👁️</button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            
            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            <p><a href="index.php">← Volver al inicio</a></p>
        </div>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>