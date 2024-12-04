<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include '../includes/conexion.php';

// Verificar si los datos del formulario han sido enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Preparar la consulta SQL para buscar al usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Validar la contraseña (lote)
        if ($contrasena === $usuario['lote']) {
            // Configurar sesión del usuario
            $_SESSION['loggedin'] = true;
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['sector'] = $usuario['sector'];

            // Redirigir al dashboard
            header('Location: ../dashboard.php');
            exit;
        } else {
            // Contraseña incorrecta
            header('Location: ../index.php?error=contraseña');
            exit;
        }
    } else {
        // Usuario no encontrado
        header('Location: ../index.php?error=usuario');
        exit;
    }

    // Cerrar conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no es un método POST, redirigir al login
    header('Location: ../index.php');
    exit;
}
?>
