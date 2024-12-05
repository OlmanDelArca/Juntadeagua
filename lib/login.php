<?php
session_start();

include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if ($contrasena === $usuario['lote']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['sector'] = $usuario['sector'];

            header('Location: ../dashboard.php');
            exit;
        } else {
            $_SESSION['error'] = 'El usuario o contraseña es incorrecto.';
            header('Location: ../index.php'); // Redirigir sin parámetros
            exit;
        }
    } else {
        $_SESSION['error'] = 'El usuario o contraseña es incorrecto.';
        header('Location: ../index.php'); // Redirigir sin parámetros
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php');
    exit;
}
?>
