<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "junta_de_agua";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
