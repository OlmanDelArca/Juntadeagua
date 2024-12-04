<?php
include '../includes/conexion.php';

// Recibir los datos del formulario
$id_contribuyente = $_POST['id_contribuyente'];
$monto = $_POST['monto'];
$fecha_pago = $_POST['fecha_pago'];
$periodo_pago = $_POST['periodo_pago'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$id_tarifa = $_POST['tarifa'];

// Verificar si ya existe un pago registrado para este contribuyente, período y tarifa
$sql_verificar = "SELECT * FROM pagos 
                  WHERE id_contribuyente = '$id_contribuyente' 
                  AND periodo_pago = '$periodo_pago' 
                  AND id_tarifa = '$id_tarifa'";

$resultado_verificar = $conn->query($sql_verificar);

if ($resultado_verificar->num_rows > 0) {
    echo "Error: Ya existe un pago registrado para este período.";
} else {
    // Si no hay pagos existentes, realizar la inserción
    $sql = "INSERT INTO pagos (id_contribuyente, monto_pago, fecha_pago, periodo_pago, fecha_vencimiento, id_tarifa) 
            VALUES ('$id_contribuyente', '$monto', '$fecha_pago', '$periodo_pago', '$fecha_vencimiento', '$id_tarifa')";

    if ($conn->query($sql) === TRUE) {
        echo "Pago registrado exitosamente.";
    } else {
        echo "Error al registrar el pago: " . $conn->error;
    }
}

$conn->close();
?>
