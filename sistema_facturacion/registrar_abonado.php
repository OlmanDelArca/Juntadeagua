<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "1101";
$dbname = "sistema_facturacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    error_log("Conexión a la base de datos exitosa");
}

// Obtener los datos del abonado desde la solicitud AJAX
$data = json_decode(file_get_contents('php://input'), true);
$nombreCompleto = $data['nombreCompleto'];
$sector = $data['sector'];
$telefono = $data['telefono'];
$email = $data['email'];
$numeroLote = $data['numeroLote'];

// Agregar mensajes de depuración
error_log("Datos recibidos: Nombre Completo: $nombreCompleto, Sector: $sector, Teléfono: $telefono, Email: $email, Número de Lote: $numeroLote");

// Insertar la información del abonado en la base de datos
$sql = "INSERT INTO abonados (nombre, sector, telefono, email, lote) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    error_log("Error en la preparación de la declaración: " . $conn->error);
    echo json_encode(['success' => false, 'error' => 'Error en la preparación de la declaración']);
    exit;
} else {
    error_log("Preparación de la declaración exitosa");
}

$stmt->bind_param("sssss", $nombreCompleto, $sector, $telefono, $email, $numeroLote);

if ($stmt->execute()) {
    error_log("Ejecución de la declaración exitosa");
    echo json_encode(['success' => true]);
} else {
    error_log("Error en la ejecución de la declaración: " . $stmt->error);
    echo json_encode(['success' => false, 'error' => 'Error en la ejecución de la declaración']);
}

$stmt->close();
$conn->close();
?>
