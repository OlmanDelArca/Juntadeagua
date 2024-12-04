<?php
include '../includes/conexion.php';

$fecha_desde = isset($_GET['fecha_desde']) ? $_GET['fecha_desde'] : null;
$fecha_hasta = isset($_GET['fecha_hasta']) ? $_GET['fecha_hasta'] : null;
$codigo_cliente = isset($_GET['codigo_cliente']) ? $_GET['codigo_cliente'] : null;

// Construir consulta SQL dinámica
$sql = "SELECT pagos.id, contribuyentes.nombre, contribuyentes.apellido, pagos.monto_pago, pagos.fecha_pago, tarifas.descripcion
        FROM pagos
        INNER JOIN contribuyentes ON pagos.id_contribuyente = contribuyentes.id
        INNER JOIN tarifas ON pagos.id_tarifa = tarifas.id
        WHERE 1=1";

if ($fecha_desde) {
    $sql .= " AND pagos.fecha_pago >= '$fecha_desde'";
}
if ($fecha_hasta) {
    $sql .= " AND pagos.fecha_pago <= '$fecha_hasta'";
}
if ($codigo_cliente) {
    $sql .= " AND contribuyentes.id = '$codigo_cliente'";
}

$sql .= " ORDER BY pagos.fecha_pago DESC";

$resultado = $conn->query($sql);

// Estilos embebidos
$output = "
<style>
    .tabla-resultados {
        width: 100%;
        margin: 10px 0;
        border-collapse: collapse;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .tabla-resultados th, .tabla-resultados td {
        padding: 10px;
        text-align: left;
        font-size: 14px;
    }
    .tabla-resultados th {
        background-color: #4082b8;
        color: white;
        text-transform: uppercase;
    }
    .tabla-resultados tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .tabla-resultados tr:hover {
        background-color: #eaf2f8;
    }
</style>
";

// Generar la tabla de resultados
$output .= "<table class='tabla-resultados'>
            <thead>
                <tr>
                    <th>ID Pago</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Monto</th>
                    <th>Fecha Pago</th>
                    <th>Tarifa</th>
                </tr>
            </thead>
            <tbody>";

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $output .= "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>{$fila['apellido']}</td>
                        <td>{$fila['monto_pago']}</td>
                        <td>{$fila['fecha_pago']}</td>
                        <td>{$fila['descripcion']}</td>
                    </tr>";
    }
} else {
    $output .= "<tr><td colspan='6'>No se encontraron resultados</td></tr>";
}
$output .= "</tbody></table>";

// Cerrar conexión
$conn->close();

// Redirigir con resultados
header('Location: ../consultarPagos.php?resultado=' . urlencode($output));
exit;
?>
