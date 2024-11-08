<?php
// Conexión a la base de datos
include '../includes/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo_electronico = $_POST['correo_electronico'];

// Verificar si es una actualización o inserción
if (!empty($id)) {
    $sql = "UPDATE contribuyentes SET nombre='$nombre', apellido='$apellido', direccion='$direccion', telefono='$telefono', correo_electronico='$correo_electronico' WHERE id=$id";
    $mensaje = "CONTRIBUYENTE ACTUALIZADO EXITOSAMENTE.";
} else {
    $sql = "INSERT INTO contribuyentes (nombre, apellido, direccion, telefono, correo_electronico) VALUES ('$nombre', '$apellido', '$direccion', '$telefono', '$correo_electronico')";
    $mensaje = "CONTRIBUYENTE GUARDADO EXITOSAMENTE.";
}

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => $mensaje]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}


$conn->close();
?>
