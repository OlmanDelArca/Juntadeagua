<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes</title>
  <link rel="stylesheet" href="css/stylesReportes.css"> 
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="icon" type="image/png" href="http://equilibriumfitness-ra.free.nf/AGUAICONO.png">
</head>
<body>
  <?php include 'includes/sidebar.html'; ?>
  
  <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>
  
  <div class="container">
    <main class="main-content">
      <header>
        <h1>Generar Reportes</h1>
        <form id="reporteForm" onsubmit="return generarReporte(event);">
          <label for="tipoReporte">Seleccione el tipo de reporte:</label>
          <select id="tipoReporte" name="tipoReporte" required>
              <option value="" disabled selected>Seleccione...</option>
              <option value="contribuyentes">Reporte de Contribuyentes</option>
              <option value="pagos">Reporte de Pagos</option>
              <option value="tarifas">Reporte de Tarifas</option>
              <option value="pagos_pendientes">Reporte de Pagos Pendientes</option>
          </select>
          <button type="submit" class="button btn-generar">Generar Reporte</button>
        </form>
      </header>
    </main>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="js/scriptReportes.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- scripts para el menu lateral -->
  <script src="js/sidebar.js"></script>

  <script>
    function generarReporte(event) {
        event.preventDefault();
        const tipoReporte = document.getElementById('tipoReporte').value;
        window.location.href = `lib/generar_reporte.php?tipo=${tipoReporte}`; 
    }
  </script>
</body>
</html>