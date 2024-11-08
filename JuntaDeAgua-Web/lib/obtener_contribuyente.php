<?php
// Conexión a la base de datos
include '../includes/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del contribuyente
$id = $_GET['id'];

// Consulta para obtener los datos del contribuyente
$sql = "SELECT * FROM contribuyentes WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Devolver los datos en formato JSON
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$conn->close();
?>
