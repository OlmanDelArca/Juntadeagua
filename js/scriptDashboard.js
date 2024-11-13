// Gráfico de resumen de pagos realizados
const ctx1 = document.getElementById('paymentsChart').getContext('2d');
const paymentsChart = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Último Mes', '3 Meses', '6 Meses', '1 Año'],
        datasets: [{
            label: 'Pagos Realizados',
            data: [120, 300, 450, 600], // Datos ejemplo.......
            backgroundColor: 'rgba(0, 51, 102, 0.6)', // Azul oscuro
            borderColor: 'rgba(0, 51, 102, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfico de porcentaje de pagos
const ctx2 = document.getElementById('percentageChart').getContext('2d');
const percentageChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Pagos Realizados', 'Pagos Pendientes'],
        datasets: [{
            label: 'Porcentaje de Pagos',
            data: [70, 30], // Datos ejemplo.....
            backgroundColor: [
                'rgba(0, 51, 102, 0.6)', // Azul oscuro
                'rgba(255, 99, 132, 0.6)' // Color diferente para contrastar
            ],
            borderColor: [
                'rgba(0, 51, 102, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    }
});

// Gráfico por zona geográfica
const ctx3 = document.getElementById('geographicChart').getContext('2d');
const geographicChart = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['Tegucigalpa', 'San Pedro Sula', 'La Ceiba', 'Choluteca'],
        datasets: [{
            label: 'Contribuyentes por Zona',
            data: [100, 200, 150, 80], // Datos ejemplo.....
            backgroundColor: 'rgba(0, 51, 102, 0.6)',
            borderColor: 'rgba(0, 51, 102, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfico de evolución de servicio ofrecido
const ctx4 = document.getElementById('serviceEvolutionChart').getContext('2d');
const serviceEvolutionChart = new Chart(ctx4, {
    type: 'line',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: 'Evolución del Servicio',
            data: [30, 50, 70, 90, 80, 100], // Datos ejemplo...
            fill: false,
            borderColor: 'rgba(0, 51, 102, 1)',
            tension: 0.1
        }]
    }
});