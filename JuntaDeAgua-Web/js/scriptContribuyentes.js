        const modal = document.getElementById('modalFormulario');
        const btn = document.getElementById('agregarBtn');
        const span = document.getElementsByClassName('close')[0];

        btn.onclick = function() {
            document.getElementById('formContribuyente').reset(); // Resetear el formulario
            document.getElementById('contribuyenteId').value = ""; // Limpiar el ID oculto
            modal.style.display = 'block';
        }

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }


    document.getElementById('formContribuyente').onsubmit = function(event) {
    event.preventDefault(); // Evitar el envío estándar del formulario
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'lib/procesar.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            Swal.fire({
                icon: response.success ? 'success' : 'error',
                title: response.success ? '¡Éxito!' : '¡Error!',
                text: response.message,
                confirmButtonText: 'OK'
            }).then(() => {
                if (response.success) {
                    location.reload(); // Recargar la página si se guardó exitosamente
                }
            });
        }
    }
    xhr.send(formData);
}



function editarContribuyente(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'lib/obtener_contribuyente.php?id=' + id, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const contribuyente = JSON.parse(xhr.responseText);
            document.getElementById('contribuyenteId').value = contribuyente.id;
            document.getElementById('nombre').value = contribuyente.nombre;
            document.getElementById('apellido').value = contribuyente.apellido;
            document.getElementById('direccion').value = contribuyente.direccion;
            document.getElementById('telefono').value = contribuyente.telefono;
            document.getElementById('correo').value = contribuyente.correo_electronico;

            modal.style.display = 'block'; // Mostrar el modal para edición
        }
    }
    xhr.send();
}



function eliminarContribuyente(id) {
    Swal.fire({
        title: '¿ESTÁS SEGURO, QUE DESEAS DESHABILITAR ESTE CONTRIBUYENTE?',
        text: "DESHABILITAR CONTRIBUYENTE",
        imageUrl: 'http://equilibriumfitness-ra.free.nf/AGUAICONO.png',
        imageWidth: 50, 
        imageHeight: 50, 
        showCancelButton: true,
        confirmButtonColor: '#007BFF',
        cancelButtonColor: '#cb6a50',
        confirmButtonText: 'SÍ, DESHABILITAR',
        cancelButtonText: 'CANCELAR'
    }).then((result) => {
        if (result.isConfirmed) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'lib/eliminar_contribuyente.php?id=' + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    Swal.fire({
                        icon: 'success',
                        title: 'CONTRIBUYENTE DESHABILITADO',
                        text: response,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();  // Recargar la página después de la eliminación
                    });
                }
            }
            xhr.send();
        }
    });
}

 
function habilitarContribuyente(id) {
    Swal.fire({
        title: '¿ESTÁS SEGURO, QUE DESEAS HABILITAR ESTE CONTRIBUYENTE?',
        imageUrl: 'http://equilibriumfitness-ra.free.nf/AGUAICONO.png',
        imageWidth: 50, 
        imageHeight: 50, 
        showCancelButton: true,
        confirmButtonColor: '#007BFF',
        cancelButtonColor: '#cb6a50',
        confirmButtonText: 'SÍ, HABILITAR',
        cancelButtonText: 'CANCELAR'
    }).then((result) => {
        if (result.isConfirmed) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'lib/habilitar_contribuyente.php?id=' + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    Swal.fire({
                        icon: 'success',
                        title: 'CONTRIBUYENTE HABILITADO',
                        text: response,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Recargar la página después de habilitar
                    });
                }
            };
            xhr.send();
        }
    });
}