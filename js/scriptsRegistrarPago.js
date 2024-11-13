// Asignar de la tabla al form
        function seleccionarContribuyente(id, nombre) {
            document.getElementById('id_contribuyente').value = id;
            document.getElementById('contribuyente').value = nombre;
        }

        function actualizarCamposTarifa() {
            const tarifaSelect = document.getElementById('tarifa');
            const tarifaSeleccionada = tarifaSelect.options[tarifaSelect.selectedIndex];

            const monto = tarifaSeleccionada.getAttribute('data-monto');
            const periodo = tarifaSeleccionada.getAttribute('data-periodo');

            document.getElementById('monto').value = monto;
            document.getElementById('periodo_pago').value = periodo;

            const fechaPago = document.getElementById('fecha_pago').value;
            if (fechaPago) {
                const fecha = new Date(fechaPago);
                switch (periodo) {
                    case 'mes':
                        fecha.setMonth(fecha.getMonth() + 1);
                        break;
                    case 'trimestre':
                        fecha.setMonth(fecha.getMonth() + 3);
                        break;
                    case 'semestre':
                        fecha.setMonth(fecha.getMonth() + 6);
                        break;
                    case 'anual':
                        fecha.setFullYear(fecha.getFullYear() + 1);
                        break;
                }

                const fechaVencimiento = fecha.toISOString().split('T')[0];
                document.getElementById('fecha_vencimiento').value = fechaVencimiento;
            }
        }

// Funcion para cargar el Header y el Footer
function loadHTML(elementID, url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById(elementID).innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el archivo:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    loadHTML('header', 'includes/header.html');
    loadHTML('footer', 'includes/footer.html');
});

//Notificacion de Pago
function registrarPago(event) {
    event.preventDefault(); 

    const formData = new FormData(document.getElementById('formPago'));

    fetch('lib/guardarPago.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const notificacion = document.getElementById('notificacion');
        notificacion.style.display = 'block';

        if (data.includes("exitosamente")) {
            notificacion.style.backgroundColor = 'lightgreen';
            notificacion.innerText = "Pago registrado exitosamente.";
        } else {
            notificacion.style.backgroundColor = 'lightcoral';
            notificacion.innerText = "Error al registrar el pago: " + data;
        }
    })
    .catch(error => {
        const notificacion = document.getElementById('notificacion');
        notificacion.style.display = 'block';
        notificacion.style.backgroundColor = 'lightcoral';
        notificacion.innerText = "Error al enviar la solicitud.";
    });
}