<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación de Facturación de Agua</title>
    <link rel="stylesheet" href="css/stylesLogin.css">
</head>
<body>
    <div class="container" id="login">
        <h1>Aplicación de Facturación de Agua</h1>
        <form id="loginForm" action="lib/login.php" method="POST">
            <input type="text" name="nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>   
        <br> 
        <a href="recuperar_contrasena.html">¿Olvidaste tu contraseña?</a>
        <a href="agregar_usuario.html">Registrar Nuevo Usuario</a>  
        </br> 
    </div>
</body>
</html>
