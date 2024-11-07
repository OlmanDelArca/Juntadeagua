<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión a MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT); // Hash de la contraseña

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nombre_usuario, $contrasena_hash);

    if ($stmt->execute()) {
        echo "Usuario registrado con éxito.";
        header("Location: login.php"); // Redirige al formulario de login después del registro
        exit();
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container" id="register">
        <h1>Registro de Usuario</h1>
        <form id="registerForm" action="agreagra_usuario.php" method="POST">
            <input type="text" name="nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Registrar</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
