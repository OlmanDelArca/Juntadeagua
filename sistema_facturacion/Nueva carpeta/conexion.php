/*<?php
$servername = "localhost";
$username = "root";
$password = "1101";
$dbname = "sistema_facturacion";

$conn = new mysqli($localhost, $root, $superadmin, $sistema_facturacion);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
*/

<?php
$servername = "localhost";
$username = "root";
$password = "1101";
$dbname = "sistema_facturacion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>