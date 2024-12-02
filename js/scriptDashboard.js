//Gráfico de pagos realizados por periodos
fetch('lib/dashboard_informacion.php?tipo=pagosPorPeriodo')
  .then(response => response.json())
  .then(data => {
    const ctx1 = document.getElementById('paymentsChart').getContext('2d');
    const paymentsChart = new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: ['Último Mes', '3 Meses', '6 Meses', '1 Año'],
        datasets: [{
          label: 'Pagos Realizados (Lps)',
          data: [data.pagosPorPeriodo[0].ultimo_mes, data.pagosPorPeriodo[0].tres_meses, data.pagosPorPeriodo[0].seis_meses, data.pagosPorPeriodo[0].un_año],
          backgroundColor: 'rgba(0, 51, 102, 0.6)',
          borderColor: 'rgba(0, 51, 102, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Cantidad (Lps)'
            }
          }
        },
        plugins: {
          title: {
            display: true,
            text: 'Resumen de Pagos Realizados'
          },
          legend: {
            display: true,
            position: 'bottom',
            labels: {
              font: {
                size: 14
              }
            }
          }
        }
      }
    });
  });

//Gráfico de porcentaje de pagos
fetch('lib/dashboard_informacion.php?tipo=porcentajePagosRealizados')
  .then(response => response.json())
  .then(data => {
    const ctx2 = document.getElementById('percentageChart').getContext('2d');
    const percentageChart = new Chart(ctx2, {
      type: 'pie',
      data: {
        labels: ['Pagos Realizados', 'Pagos Pendientes'],
        datasets: [{
          label: 'Porcentaje de Pagos',
          data: [data.porcentajePagosRealizados[0].pagos_realizados, data.porcentajePagosRealizados[0].pagos_pendientes],
          backgroundColor: [
            'rgba(0, 51, 102, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderColor: [
            'rgba(0, 51, 102, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          legend: {
            display: true,
            position: 'bottom',
            labels: {
              font: {
                size: 14
              }
            }
          }
        }
      }
    });
  });

//Gráfico por zona geográfica
fetch('lib/dashboard_informacion.php?tipo=contribuyentesPorZona')
  .then(response => {
    if (!response.ok) {
      throw new Error('Error en la red: ' + response.statusText);
    }
    return response.json();
  })
  .then(data => {
    
    if (data.contribuyentesPorZona && Array.isArray(data.contribuyentesPorZona)) {
      const ctx3 = document.getElementById('geographicChart').getContext('2d');
      const geographicChart = new Chart(ctx3, {
        type: 'bar',
        data: {
          labels: data.contribuyentesPorZona.map(zona => zona.zona), 
          datasets: [{
            label: 'Contribuyentes por Zona',
            data: data.contribuyentesPorZona.map(zona => zona.cantidad_contribuyentes), 
            backgroundColor: 'rgba(0, 51, 102, 0.6)', 
            borderColor: 'rgba(0, 51, 102, 1)', 
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: '' // eje Y
              }
            },
            x: {
              title: {
                display: true,
                text: '' // eje X
              }
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top'
            }
          }
        }
      });
    } else {
      console.error('La estructura de datos no es la esperada:', data);
    }
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });

//Gráfico de evolución del servicio
fetch('lib/dashboard_informacion.php?tipo=evolucionServicio')
  .then(response => {
    if (!response.ok) {
      throw new Error('Error en la red: ' + response.statusText);
    }
    return response.json();
  })
  .then(data => {
    
    if (data.evolucionServicio && Array.isArray(data.evolucionServicio)) {
      const ctx4 = document.getElementById('serviceEvolutionChart').getContext('2d');
      const serviceEvolutionChart = new Chart(ctx4, {
        type: 'line',
        data: {
          labels: data.evolucionServicio.map(item => item.fecha_pago), 
          datasets: [{
            label: 'Evolución del Servicio',
            data: data.evolucionServicio.map(item => item.total_pagos), 
            backgroundColor: 'rgba(0, 51, 102, 0.6)', 
            borderColor: 'rgba(0, 51, 102, 1)',
            borderWidth: 1,
            fill: true 
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Lps' // eje Y
              }
            },
            x: {
              title: {
                display: true,
                text: 'Fecha de Pago' //eje X
              }
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top'
            }
          }
        }
      });
    } else {
      console.error('La estructura de datos no es la esperada:', data);
    }
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });


//Tabla de contribuyentes pendientes de pago
fetch('lib/dashboard_informacion.php?tipo=pagosPendientes')
  .then(response => {
    if (!response.ok) {
      throw new Error('Error en la red: ' + response.statusText);
    }
    return response.json();
  })
  .then(data => {
    const tableBody = document.getElementById('pendingPaymentsTable').getElementsByTagName('tbody')[0];
    
    
    tableBody.innerHTML = '';

    if (data.pagosPendientes && Array.isArray(data.pagosPendientes)) {
      data.pagosPendientes.forEach(contribuyente => {
        const row = tableBody.insertRow();
        const cell1 = row.insertCell();
        const cell2 = row.insertCell();
        const cell3 = row.insertCell();
        const cell4 = row.insertCell();
        const cell5 = row.insertCell();
        const cell6 = row.insertCell();
        
        //En caso de no haber datos en las celdas de la tabla se mostrará S/D -->(Sin Datos)...
        cell1.textContent = contribuyente.id || 'S/D';
        cell2.textContent = contribuyente.nombre || 'S/D';
        cell3.textContent = contribuyente.apellido || 'S/D';
        cell4.textContent = contribuyente.direccion || 'S/D';
        cell5.textContent = contribuyente.telefono || 'S/D';
        cell6.textContent = contribuyente.correo_electronico || 'S/D';
      });
    } else {
      
      const row = tableBody.insertRow();
      const cell = row.insertCell();
      cell.colSpan = 6; 
      cell.textContent = 'No hay contribuyentes pendientes de pago.';
    }
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });
