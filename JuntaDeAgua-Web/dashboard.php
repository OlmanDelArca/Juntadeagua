<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesDashboard.css">
    <!-- incluye el estilo para el menu lateral -->
    <link rel="stylesheet" href="css/sidebar.css">
    
    <link rel="icon" href="AGUA.png" type="assets/images/AGUA.png">
    <title>Dashboard - Junta Administradora de Agua Potable y Saneamiento</title>
</head>
<body>
    <!-- incluye el menu lateral el cual esta en la carpeta includes -->
    <?php include 'includes/sidebar.html'; ?>
    <!-- boton para abrir el menu lateral -->
    <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>

    <div class="container">
        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>
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
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Ubicación</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Juan</td>
                                <td>Pérez</td>
                                <td>Tegucigalpa</td>
                                <td>12345678</td>
                                <td>juan@example.com</td>
                            </tr>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/scriptDashboard.js"></script>
    <!-- scripts para el menu lateral -->
    <script src="js/sidebar.js"></script>
</body>
</html>
