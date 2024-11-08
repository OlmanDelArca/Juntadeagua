<?php
// Conexión a la base de datos
include '../includes/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del contribuyente
$id = $_GET['id'];

// Eliminar o marcar el contribuyente como inactivo
$sql = "UPDATE contribuyentes SET estado = 'inactivo' WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "CONTRIBUYENTE DESHABILITADO CORRECTAMENTE";
} else {
    echo "ERROR AL DESHABILITAR EL CONTRIBUYENTE: " . $conn->error;
}

$conn->close();
?>
