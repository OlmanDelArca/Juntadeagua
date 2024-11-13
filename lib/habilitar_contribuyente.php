<?php
// Conexión a la base de datos
include '../includes/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del contribuyente
$id = $_GET['id'];

// Actualizar el estado del contribuyente a "activo"
$sql = "UPDATE contribuyentes SET estado = 'activo' WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "CONTRIBUYENTE HABILITADO, CORRECTAMENTE";
} else {
    echo "ERROR AL HABILITAR EL CONTRIBUYENTE: " . $conn->error;
}

$conn->close();
?>
