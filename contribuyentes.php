<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="http://equilibriumfitness-ra.free.nf/AGUAICONO.png">
    <link rel="stylesheet" href="css/stylesContribuyentes.css">
    <!-- incluye el estilo para el menu lateral -->
    <link rel="stylesheet" href="css/sidebar.css">

    <title>ADMINISTRAR CONTRIBUYENTES</title>
</head>
<body>
    <!-- incluye el menu lateral el cual esta en la carpeta includes -->
    <?php include 'includes/sidebar.html'; ?>
    <!-- boton para abrir el menu lateral -->
    <button class="openbtn" onclick="openNav()">&#9776; Abrir Menú</button>

    <div class="container">
        <h1>ADMINISTRAR CONTRIBUYENTES</h1>
        <button id="agregarBtn">AGREGAR CONTRIBUYENTE</button>

        <table style="border: 2px solid black">
       
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>DIRECCIÓN</th>
                    <th>TELÉFONO</th>
                    <th>CORREO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="tablaContribuyentes">
            <?php
        // Conexión a la base de datos
        include 'includes/conexion.php';

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta para obtener los contribuyentes
        $sql = "SELECT * FROM contribuyentes";
        $result = $conn->query($sql);

        // Mostrar resultados en la tabla
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $disabled = ($row['estado'] == 'inactivo') ? 'DESABILITADO' : '';
                $buttonText = ($row['estado'] == 'inactivo') ? 'HABILITAR' : 'DESHABILITAR';
                $onClickFunction = ($row['estado'] == 'inactivo') ? "habilitarContribuyente({$row['id']})" : "eliminarContribuyente({$row['id']})";
                $rowColor = ($row['estado'] == 'inactivo') ? 'style="background-color: rgba(255, 0, 0, 0.2);"' : '';
                echo "<tr id='contribuyente-{$row['id']}' class='{$disabled}' {$rowColor}>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['apellido']}</td>
                        <td>{$row['direccion']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['correo_electronico']}</td>
                        <td class='acciones'>
                            <button onclick='editarContribuyente({$row['id']})'>EDITAR</button>
                            <button onclick='{$onClickFunction}'>{$buttonText}</button>
                        
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>NO HAY CONTRIBUYENTES REGISTRADOS</td></tr>";
        }
        $conn->close();
    ?>
            </tbody>
        </table>

        <!-- Formulario Modal -->
        <div id="modalFormulario" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>FORMULARIO DE CONTRIBUYENTE</h2>
                <form id="formContribuyente" action="lib/procesar.php" method="post">
                    <input type="hidden" name="id" id="contribuyenteId">
                    
                    <label for="nombre">NOMBRE:</label>
                    <input type="text" name="nombre" id="nombre" required>

                    <label for="apellido">APELLIDO:</label>
                    <input type="text" name="apellido" id="apellido" required>

                    <label for="direccion">DIRECCIÓN:</label>
                    <input type="text" name="direccion" id="direccion" required>

                    <label for="telefono">TELÉFONO:</label>
                    <input type="text" name="telefono" id="telefono" required pattern="[0-9]{8,12}" title="Debe ingresar entre 8 y 12 dígitos numéricos.">

                    <label for="correo">CORREO:</label>
                    <input type="email" name="correo_electronico" id="correo">

                    <button type="submit">GUARDAR</button>
                </form>
            </div>
        </div>
    </div>

    <!-- scripts para el menu lateral -->
    <script src="js/scriptContribuyentes.js"></script>
    <script src="js/sidebar.js"></script>
</body>
</html>