<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="reset-container">
        <h2>Restablecer Contraseña</h2>
        <form id="resetForm" action="restablecer_contrasena.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" required>
            <input type="password" name="nueva_contrasena" placeholder="Nueva Contraseña" required>
            <button type="submit">Restablecer Contraseña</button>
        </form>
    </div>
</body>
</html>
