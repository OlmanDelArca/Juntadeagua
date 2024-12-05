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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesDashboard.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/HeaderFooter.css">

    <link rel="icon" type="image/png" href="http://equilibriumfitness-ra.free.nf/AGUAICONO.png">
    <title>Dashboard - Junta Administradora de Agua Potable y Saneamiento</title>
</head>

<body>
    <?php include 'includes/sidebar.html'; ?>
    <?php include 'includes/header.html'; ?>

    <div id="main">
        <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>
        <div class="container">
            <div class="dashboard">
                <div class="charts">
                    <div class="chart-container">
                        <canvas id="paymentsChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="percentageChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="geographicChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="serviceEvolutionChart"></canvas>
                    </div>
                </div>

                <div class="pending-contributors">
                    <h2>Contribuyentes Pendientes de Pago</h2>
                    <table id="pendingPaymentsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>DIRECCION</th>
                                <th>TELEFONO</th>
                                <th>CORREO ELECTRÓNICO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se agregarán aquí automáticamente por JS (scriptDashboard.js) -->
                        </tbody>
                    </table>
                </div>

                <!-- Iframe de OpenStreetMap -->
                <div class="map-container">
                    <h2>Mapa de la Zona</h2>
                    <iframe
                        src="https://www.openstreetmap.org/export/embed.html?bbox=-91.01074218750001%2C12.629845783456634%2C-83.94653320312501%2C16.035479181825497&amp;layer=mapnik"
                        allowfullscreen="" loading="lazy"></iframe>
                    <small><a href="https://www.openstreetmap.org/#map=8/14.339/-87.479" class="map-link">Ver el mapa
                            más grande</a></small>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/scriptDashboard.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/scriptLogout.js"></script>
</body>

</html>