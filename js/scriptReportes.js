document.getElementById('reporteForm').addEventListener('submit', function(event) { event.preventDefault();

    const tipoReporte = document.getElementById('tipoReporte').value;
    
    window.location.href = `lib/generar_reporte.php?tipo=${tipoReporte}`;});