<?php
session_start();

// Aquí deberías validar las credenciales con tu base de datos
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

// Supongamos que las credenciales son correctas
if ($nombre_usuario == 'root' && $contrasena == '1011') {
    $_SESSION['loggedin'] = true;
    header('Location: ../dashboard.php');
    exit;
} else {
    // Si las credenciales son incorrectas, redirigir de nuevo al login
    header('Location: index.php');
    exit;
}
?>
