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
    <link rel="icon" href="agua.png" type="image/x-icon">
    <link rel="stylesheet" href="css/stylesConsultarPagos.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/HeaderFooter.css">
    <link rel="icon" type="image/png" href="http://equilibriumfitness-ra.free.nf/AGUAICONO.png">
    <title>Historial Pagos</title>
</head>

<body>
    <!-- Menú lateral -->
    <?php include 'includes/sidebar.html'; ?>
    <?php include 'includes/header.html'; ?>

    <div id="main">
        <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>

        <div class="container">
            <div class="caja">
                <h1>Historial de pagos</h1>
    
                <div class="contenedor">
                    <form id="filtros" method="GET" action="lib/ConsultaPagos.php">
                        <label for="desdeInput">Desde:</label>
                        <input class="desdeInput" id="desdeInput" type="date" name="fecha_desde">
                
                        <label for="hastaInput">Hasta:</label>
                        <input class="hastaInput" id="hastaInput" type="date" name="fecha_hasta"><br><br>
                
                        <label for="buscarInput">Código del Cliente:</label>
                        <input class="buscarInput" id="buscarInput" type="search" name="codigo_cliente" placeholder="Buscar">
                
                        <button class="boton" type="submit">Buscar</button>
                    </form>
                
                    <!-- Tabla con resultados -->
                    <div class="resultado">
                        <?php if (isset($_GET['resultado'])): ?>
                        <?php echo $_GET['resultado']; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.html'; ?>
    <!-- scripts para el menú lateral -->
    <script src="js/sidebar.js"></script>
    <script src="js/scriptLogout.js"></script>
</body>

</html>