<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container" id="adminPanel">
        <h1>Panel de Administrador</h1>
        <br> <button id="searchSubscriber">Buscar Abonado</button><br>
        <br><button id="registerSubscriber">Registrar Abonado</button> <br>
        <div id="subscriberSection" style="display: none;">
            <h2>Búsqueda de Abonado</h2>
            <input type="text" id="subscriberCode" placeholder="Código de Cliente Único">
            <button id="searchButton">Buscar</button>
            <div id="subscriberInfo"></div>
            <button id="payButton" style="display: none;">Pagar Tarifa</button>
        </div>
        <div id="registrationSection" style="display: none;">
            <h2>Registrar Nuevo Abonado</h2>
            <form id="registrationForm">
                <input type="text" id="nombreCompleto" placeholder="Nombre Completo" required>
                <input type="text" id="sector" placeholder="Sector" required>
                <input type="text" id="telefono" placeholder="Teléfono" required>
                <input type="email" id="email" placeholder="Correo Electrónico" required>
                <input type="text" id="numeroLote" placeholder="Número de Lote" required>
                <button type="button" id="registerButton">Registrar</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
