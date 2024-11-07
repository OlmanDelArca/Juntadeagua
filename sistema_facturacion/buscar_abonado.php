<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "1101";
$dbname = "sistema_facturacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el código del abonado desde la solicitud AJAX
$data = json_decode(file_get_contents('php://input'), true);
$codigo = $data['codigo'];

// Buscar la información del abonado en la base de datos
$sql = "SELECT * FROM abonados WHERE codigo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $abonado = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'nombre' => $abonado['nombre'],
        'sector' => $abonado['sector'],
        'telefono' => $abonado['telefono'],
        'email' => $abonado['email'],
        'lote' => $abonado['lote']
    ]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
