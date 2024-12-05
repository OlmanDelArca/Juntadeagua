<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="css/stylesLogin.css">
</head>
<body>
    <div class="user-container">
        <h2>Agregar Usuario</h2>
        <form id="userForm" action="lib/agregar_usuario.php" method="POST">
            <input type="nombre_usuario" name="nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="sector" name="sector" placeholder="sector" required>
            <input type="telefono" name="telefono" placeholder="telefonoa" required>
            <input type="email" name="email" placeholder="email" required>
            <input type="lote" name="lote" placeholder="lote" required>
            <button type="submit">Agregar</button>
        </form>
    </div>
</body>
</html>