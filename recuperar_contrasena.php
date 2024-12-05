<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/stylesLogin.css">
    <link rel="icon" type="image/png" href="http://equilibriumfitness-ra.free.nf/AGUAICONO.png">
</head>
<body>
    <div class="recovery-container">
        <h2>Recuperar Contraseña</h2>
        <form id="recoveryForm" action="lib/recuperar_contrasena.php" method="POST">
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <button type="submit">Enviar Enlace de Recuperación</button>
        </form>
    </div>
</body>
</html>