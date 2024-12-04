<?php
include '../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        $sql = "UPDATE usuarios SET token='$token' WHERE email='$email'";
        $conn->query($sql);

        // Enviar el enlace de recuperación por correo
        $to = $email;
        $subject = "Recuperación de Contraseña";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: http://tu_dominio.com/restablecer_contrasena.php?token=$token";
        $headers = "From: no-reply@tu_dominio.com";

        mail($to, $subject, $message, $headers);

        echo "Se ha enviado un enlace de recuperación a tu correo electrónico.";
    } else {
        echo "Correo electrónico no encontrado.";
    }
}
?>
