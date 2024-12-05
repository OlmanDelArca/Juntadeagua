<?php
session_start();
$error_message = '';

if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']); // Eliminar el mensaje de error después de mostrarlo
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Aplicación de Facturación de Agua</title>
    <link rel="stylesheet" href="css/stylesLogin.css">
    <link rel="icon" type="image/png" href="http://equilibriumfitness-ra.free.nf/AGUAICONO.png">
</head>

<body>
    <div class="container" id="login">
        <h1>Aplicación de Facturación de Agua</h1>
        <?php if ($error_message): ?>
        <div class="error-message">
            <p>
                <?php echo $error_message; ?>
            </p>
        </div>
        <?php endif; ?>

        <form id="loginForm" action="lib/login.php" method="POST">
            <input type="text" name="nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <br>
        <!-- <a href="recuperar_contrasena.html">¿Olvidaste tu contraseña?</a>
        <a href="agregar_usuario.html">Registrar Nuevo Usuario</a>  -->
        </br>
    </div>
</body>

</html>