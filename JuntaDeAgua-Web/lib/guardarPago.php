<?php
include '../includes/conexion.php';

$id_contribuyente = $_POST['id_contribuyente'];
$monto = $_POST['monto'];
$fecha_pago = $_POST['fecha_pago'];
$periodo_pago = $_POST['periodo_pago'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$id_tarifa = $_POST['tarifa'];

$sql = "INSERT INTO pagos (id_contribuyente, monto_pago, fecha_pago, periodo_pago, fecha_vencimiento, id_tarifa) 
        VALUES ('$id_contribuyente', '$monto', '$fecha_pago', '$periodo_pago', '$fecha_vencimiento', '$id_tarifa')";

if ($conn->query($sql) === TRUE) {
    echo "Pago registrado exitosamente.";
} else {
    echo "Error al registrar el pago: " . $conn->error;
}

$conn->close();
?>
