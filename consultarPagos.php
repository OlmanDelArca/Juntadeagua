<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="agua.png" type="image/x-icon">
    <link rel="stylesheet" href="css/stylesConsultarPagos.css">
    <!-- incluye el estilo para el menu lateral -->
    <link rel="stylesheet" href="css/sidebar.css">

    <title>Historial Pagos</title>
</head>
<body>
    <!-- incluye el menu lateral el cual esta en la carpeta includes -->
    <?php include 'includes/sidebar.html'; ?>
    <!-- boton para abrir el menu lateral -->
    <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>

    <h1>Historial de pagos</h1>

    <div class="contenedor">
        <label for="desdeInput">Desde:</label>
        <input class="desdeInput"  required id="desdeInput" type="date" >
        <label for="hastaInput">Hasta:</label>
        <input class="hastaInput" required id="hastaInput" type="date" ><br><br>
        <label for="">Codigo de cliente</label><br>
        <input class="buscarInput" id="buscarInput" type="search" placeholder="Buscar">
        <button class="boton" id="boton" type="button" >Buscar</button>
        <h2 id="listaInventario"></h2>

    </div>
    
    <!-- scripts para el menu lateral -->
    <script src="js/sidebar.js"></script>
</body>

</html>