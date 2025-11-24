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
    <title>ConnectHub - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🚀 ConnectHub</h1>
            <p>Conecta y comunícate con tus amigos</p>
        </header>
        
        <div class="hero">
            <h2>Bienvenido a ConnectHub</h2>
            <p>La plataforma de mensajería más simple y eficiente</p>
            <div class="cta-buttons">
                <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
                <a href="register.php" class="btn btn-secondary">Registrarse</a>
            </div>
        </div>
        
        <div class="features">
            <div class="feature">
                <h3>💬 Mensajería Instantánea</h3>
                <p>Chatea en tiempo real con tus contactos</p>
            </div>
            <div class="feature">
                <h3>👥 Gestión de Contactos</h3>
                <p>Agrega y gestiona tus contactos fácilmente</p>
            </div>
            <div class="feature">
                <h3>🔒 Seguro y Privado</h3>
                <p>Tus conversaciones están protegidas</p>
            </div>
        </div>
    </div>
</body>
</html>