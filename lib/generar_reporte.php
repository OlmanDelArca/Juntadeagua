<?php
// Conexión a la base de datos
include '../includes/conexion.php'; 

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    $query = "";
    $data = [];
    
    switch ($tipo) {
        case 'contribuyentes':
            $query = "SELECT * FROM contribuyentes WHERE estado = 1 ORDER BY id ASC";
            break;

        case 'pagos':
            $query = "SELECT * FROM pagos ORDER BY id ASC";
            break;

        case 'tarifas':
            $query = "SELECT id, descripcion, monto_tarifa FROM tarifas ORDER BY id ASC"; 
            break;

        case 'pagos_pendientes':
            $query = "SELECT DISTINCT 
                      c.id AS contribuyente_id,
                      c.nombre,
                      c.apellido,
                      c.direccion,
                      c.telefono,
                      c.correo_electronico,
                      p.id AS pago_id,
                      p.monto_pago,
                      p.fecha_vencimiento,
                      p.periodo_pago
FROM 
    contribuyentes c
LEFT JOIN 
    pagos p ON c.id = p.id_contribuyente
WHERE 
    c.estado = 1 AND (p.fecha_vencimiento < CURDATE() OR p.fecha_vencimiento IS NULL)
ORDER BY p.fecha_vencimiento ASC
LIMIT 0, 50;";
            break;

        default:
            echo "Tipo de reporte no válido.";
            exit;
    }

    
    if ($query) {
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }

    $conn->close();
} else {
    
    echo "No se ha especificado el tipo de reporte.";
    exit;
}

function formatTipo($tipo) {
    $titulos = [
        'contribuyentes' => 'Contribuyentes',
        'pagos' => 'Pagos',
        'tarifas' => 'Tarifas',
        'pagos_pendientes' => 'Pagos Pendientes'
    ];

    return isset($titulos[$tipo]) ? $titulos[$tipo] : 'Tipo de Reporte Desconocido';
}

$tipo_formateado = formatTipo($tipo);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de <?php echo htmlspecialchars($tipo_formateado); ?></title>
    <link rel="stylesheet" href="../css/stylesReportes.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</head>
<body>
    <h1>Reporte de <?php echo htmlspecialchars($tipo_formateado); ?></h1>
    
    <div style="margin-bottom: 20px;">
    <a href="../reportes.php" class="button btn-regresar">Regresar</a>
    <button id="generar-pdf" class="button btn-descargar">Descargar PDF</button>
  </div>

    <table id="reporteTable">
        <thead>
            <tr>
                <?php if ($tipo === 'contribuyentes'): ?>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                <?php elseif ($tipo === 'pagos'): ?>
                    <th>ID Pago</th>
                    <th>ID Contribuyente</th>
                    <th>Monto Pago</th>
                    <th>Fecha Vencimiento</th>
                <?php elseif ($tipo === 'tarifas'): ?>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                <?php elseif ($tipo === 'pagos_pendientes'): ?>
                    <th>ID Contribuyente</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>ID Pago</th>
                    <th>Monto Pago</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Periodo de Pago</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                <?php if ($tipo === 'contribuyentes'): ?>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['correo_electronico']); ?></td>
                    <?php elseif ($tipo === 'pagos'): ?>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_contribuyente']); ?></td>
                        <td><?php echo htmlspecialchars($row['monto_pago']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_vencimiento']); ?></td>
                    <?php elseif ($tipo === 'tarifas'): ?>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                        <td><?php echo isset($row['monto_tarifa']) ? htmlspecialchars($row['monto_tarifa']) : 'S/D'; ?></td> 
                    <?php elseif ($tipo === 'pagos_pendientes'): ?>
                        <td><?php echo htmlspecialchars($row['contribuyente_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['correo_electronico']); ?></td>
                        <td><?php echo isset($row['pago_id']) ? htmlspecialchars($row['pago_id']) : 'S/D'; ?></td>
                        <td><?php echo isset($row['monto_pago']) ? htmlspecialchars($row['monto_pago']) : 'S/D'; ?></td>
                        <td><?php echo isset($row['fecha_vencimiento']) ? htmlspecialchars($row['fecha_vencimiento']) : 'S/D'; ?></td>
                        <td><?php echo isset($row['periodo_pago']) ? htmlspecialchars($row['periodo_pago']) : 'S/D'; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        document.getElementById('generar-pdf').addEventListener('click', function() {
            const pdf = new jsPDF('l', 'pt', 'a4'); 
            const table = document.getElementById('reporteTable');

           
            html2canvas(table, { scale: 2 }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 800; // Ancho de la imagen en el reporte PDF
                const pageHeight = pdf.internal.pageSize.height; 
                const imgHeight = (canvas.height * imgWidth) / canvas.width; 
                let heightLeft = imgHeight;

                let position = 0;

                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('<?php echo htmlspecialchars($tipo_formateado); ?>.pdf');
            });
        });
    </script>
</body>
</html>


