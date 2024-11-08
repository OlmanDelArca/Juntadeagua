<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junta Administradora de Agua Potable y Saneamiento</title>
    <link rel="stylesheet" href="css/stylesRegistrarPago.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="icon" href="AGUA.png" type="assets/images/AGUA.png">
</head>
<body>
    <?php include 'includes/sidebar.html'; ?>

    <div id="main">
        <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>

        <div class="container">
        <div class="caja">
                <h2>Registro de Nuevo Pago</h2>
                <!-- Contenedor para notificaciones -->
                <div id="notificacion" style="display: none; padding: 10px; margin-bottom: 15px;"></div>

                <form id="formPago" onsubmit="registrarPago(event)">
                    <div class="form-group">
                        <label for="contribuyente">Contribuyente:</label>
                        <input type="text" id="contribuyente" name="contribuyente" readonly>
                    </div>
                    <div class="form-group">
                        <label for="monto">Monto Pagado:</label>
                        <input type="number" step="0.01" id="monto" name="monto" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fecha_pago">Fecha de Pago:</label>
                        <input type="date" id="fecha_pago" name="fecha_pago" required>
                    </div>
                    <div class="form-group">
                        <label for="periodo_pago">Período de Pago:</label>
                        <input type="text" id="periodo_pago" name="periodo_pago" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                        <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="tarifa">Tarifa:</label>
                        <select id="tarifa" name="tarifa" required onchange="actualizarCamposTarifa()">
                            <option value="" selected disabled>Seleccione una tarifa</option>
                            <?php
                                include 'includes/conexion.php';

                                if ($conn->connect_error) {
                                    die("Error de conexión: " . $conn->connect_error);
                                }

                                $sql = "SELECT id, descripcion, monto_tarifa, periodo_pago FROM tarifas";
                                $resultado = $conn->query($sql);

                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "' data-monto='" . $row['monto_tarifa'] . "' data-periodo='" . $row['periodo_pago'] . "'>" . $row['descripcion'] . "</option>";
                                    }
                                } else {
                                    echo "<option disabled>No hay tarifas disponibles</option>";
                                }

                                $conn->close();
                            ?>
                        </select>
                    </div>
                    <input type="hidden" id="id_contribuyente" name="id_contribuyente">
                    <button type="submit">Registrar Pago</button>
                </form>
            </div>

        <div class="caja">
            <h3>Lista de Contribuyentes</h3>
            <table id="tablaContribuyentes">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                            include 'includes/conexion.php';

                            if ($conn->connect_error) {
                                die("Error de conexión: " . $conn->connect_error);
                            }

                            $sql = "SELECT id, nombre, direccion, telefono FROM contribuyentes";
                            $resultado = $conn->query($sql);

                            if ($resultado->num_rows > 0) {
                                while($row = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "<td>" . $row['direccion'] . "</td>";
                                    echo "<td>" . $row['telefono'] . "</td>";
                                    echo "<td><button type='button' onclick='seleccionarContribuyente(" . $row['id'] . ", \"" . $row['nombre'] . "\")'>Seleccionar</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No hay contribuyentes registrados</td></tr>";
                            }

                            $conn->close();
                        ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>

    <script src="js/scriptsRegistrarPago.js"></script>
    <!-- scripts para el menu lateral -->
    <script src="js/sidebar.js"></script>
</body>
</html>
