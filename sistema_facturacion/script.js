document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM completamente cargado y parseado');

    const searchSubscriberButton = document.getElementById('searchSubscriber');
    const registerSubscriberButton = document.getElementById('registerSubscriber');
    const subscriberSection = document.getElementById('subscriberSection');
    const registrationSection = document.getElementById('registrationSection');
    const registerButton = document.getElementById('registerButton');

    // Verificar si los elementos están correctamente seleccionados
    console.log('Elementos seleccionados:', {
        searchSubscriberButton,
        registerSubscriberButton,
        subscriberSection,
        registrationSection,
        registerButton
    });

    // Mostrar la sección de búsqueda de abonado cuando se presiona el botón "Buscar Abonado"
    searchSubscriberButton.addEventListener('click', function() {
        console.log('Botón "Buscar Abonado" presionado');
        subscriberSection.style.display = 'block';
        registrationSection.style.display = 'none';
    });

    // Mostrar la sección de registro de abonado cuando se presiona el botón "Registrar Abonado"
    registerSubscriberButton.addEventListener('click', function() {
        console.log('Botón "Registrar Abonado" presionado');
        registrationSection.style.display = 'block';
        subscriberSection.style.display = 'none';
    });

    // Manejar el evento de clic del botón de registro
    registerButton.addEventListener('click', function() {
        console.log('Botón de registro presionado');

        const nombreCompleto = document.getElementById('nombreCompleto').value;
        const sector = document.getElementById('sector').value;
        const telefono = document.getElementById('telefono').value;
        const email = document.getElementById('email').value;
        const numeroLote = document.getElementById('numeroLote').value;

        console.log('Datos del formulario:', {
            nombreCompleto,
            sector,
            telefono,
            email,
            numeroLote
        });

        // Aquí deberías realizar una solicitud AJAX para registrar el abonado
        fetch('registrar_abonado.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nombreCompleto: nombreCompleto,
                sector: sector,
                telefono: telefono,
                email: email,
                numeroLote: numeroLote
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Abonado registrado con éxito');
                alert('Abonado registrado con éxito');
                // Limpiar el formulario
                document.getElementById('registrationForm').reset();
            } else {
                console.log('Error al registrar el abonado:', data.error);
                alert('Error al registrar el abonado: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al registrar el abonado');
        });
    });
});
