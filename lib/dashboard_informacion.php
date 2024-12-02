<?php
 //Conexión a la base de datos
include '../includes/conexion.php';

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

//Función para obtener los pagos realizados por periodo
function getPagosPorPeriodo() {
    global $conn;
    $sql = "SELECT 
        SUM(CASE WHEN fecha_pago BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() THEN monto_pago ELSE 0 END) AS ultimo_mes,
        SUM(CASE WHEN fecha_pago BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND CURDATE() THEN monto_pago ELSE 0 END) AS tres_meses,
        SUM(CASE WHEN fecha_pago BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND CURDATE() THEN monto_pago ELSE 0 END) AS seis_meses,
        SUM(CASE WHEN fecha_pago BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE() THEN monto_pago ELSE 0 END) AS un_año
    FROM pagos;";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
}

//Funcion para obtener el porcentaje de pagos realizados y los pagos pendientes
function getPorcentajePagosRealizados() {
    global $conn;
    $sql = "SELECT 
                COUNT(DISTINCT p.id_contribuyente) * 100 / (SELECT COUNT(*) FROM contribuyentes WHERE estado = 1) AS pagos_realizados,
                100 - (COUNT(DISTINCT p.id_contribuyente) * 100 / (SELECT COUNT(*) FROM contribuyentes WHERE estado = 1)) AS pagos_pendientes
            FROM 
                pagos p
            WHERE 
                p.id_contribuyente IN (SELECT id FROM contribuyentes WHERE estado = 1)
                AND p.fecha_vencimiento >= CURDATE();";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
}

//Función para obtener los contribuyentes por zona geográfica
function getContribuyentesPorZona() {
    global $conn;
    $sql = "SELECT 
        SUBSTRING_INDEX(direccion, ',', 1) AS zona, 
        COUNT(*) AS cantidad_contribuyentes
    FROM contribuyentes
    WHERE estado = 1
    GROUP BY zona;";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
}

//Función para obtener la evolución del servicio
function getEvolucionServicio() {
    global $conn;
    $sql = "SELECT fecha_pago, SUM(monto_pago) AS total_pagos 
            FROM pagos
            GROUP BY fecha_pago
            ORDER BY fecha_pago;";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
}

//TABLA - Función para obtener los contribuyentes pendientes de pago
function getPagosPendientes() {
    global $conn;
    $sql = "SELECT DISTINCT
    c.id,
    c.nombre,
    c.apellido,
    c.direccion,
    c.telefono,
    c.correo_electronico
FROM 
    contribuyentes c
LEFT JOIN 
    pagos p ON c.id = p.id_contribuyente
WHERE 
    c.estado = 1 AND (p.fecha_vencimiento < CURDATE() OR p.fecha_vencimiento IS NULL)
LIMIT 0, 25;";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
}

$tipo = $_GET['tipo'];

header('Content-type: application/json');

switch ($tipo) {
    case 'pagosPorPeriodo':
        echo json_encode(array('pagosPorPeriodo' => getPagosPorPeriodo()));
        break;
    case 'porcentajePagosRealizados':
        echo json_encode(array('porcentajePagosRealizados' => getPorcentajePagosRealizados()));
        break;
    case 'contribuyentesPorZona':
        echo json_encode(array('contribuyentesPorZona' => getContribuyentesPorZona()));
        break;
    case 'evolucionServicio':
        echo json_encode(array('evolucionServicio' => getEvolucionServicio()));
        break;
    case 'pagosPendientes':
        echo json_encode(array('pagosPendientes' => getPagosPendientes()));
        break;
    default:
        echo json_encode(array('error' => 'Tipo de datos inválido'));
        break;
}

$conn->close();
?>



