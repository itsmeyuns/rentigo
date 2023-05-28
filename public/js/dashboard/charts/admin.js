const agentsChart = document.getElementById('agentsChart').getContext('2d');
const reservationsContrats = document.getElementById('reservationsContrats').getContext('2d');
const depensesGainsChart = document.getElementById('depensesGainsChart').getContext('2d');

$.ajax({
  type: "GET",
  url: "/agents-contrats-chart",
  success: function (response) {
    new Chart(agentsChart, {
      type: 'bar',
      data: {
        labels: response.labels,
        datasets: [{
          label: 'Nombre de contrats',
          data: response.data,
          backgroundColor: '#2196f3',
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: Math.max(...response.data) + 5,
            ticks: {
              stepSize: 1
            },
            title: {
              display: true,
              text: 'Nombre de contrats'
            }
          },
          x: {
            ticks: {
              stepSize: 1
            },
            title: {
              display: true,
              text: 'Agents'
            }
          }
        }
      }
    });
  }
});

$.ajax({
  type: "GET",
  url: "/reservations-contrats-chart",
  success: function (response) {
    new Chart(reservationsContrats, {
      type: 'line',
      data: {
        labels: response.labels,
        datasets: [
          {
            label: 'Reservations',
            data: response.reservations,
            backgroundColor: '#09bb9f',
            borderColor: '#09bb9f',
            borderWidth: 1
          },
          {
            label: 'Contracts',
            data: response.contracts,
            backgroundColor: '#ffb55f',
            borderColor: '#ffb55f',
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: Math.max(...response.reservations,...response.contracts) + 5,
            title: {
              display: true,
              text: 'Nombre'
            },
          },
          x: {
            title: {
              display: true,
              text: 'Mois'
            }
          }
        }
      }
    });
  }
});

$.ajax({
  type: "GET",
  url: "/depenses-gains-chart",
  success: function (response) {
    new Chart(depensesGainsChart, {
      type: 'line',
      data: {
        labels: response.labels,
        datasets: [
          {
            label: 'Gains',
            data: response.gains,
            backgroundColor: '#4472c3',
            borderColor: '#4472c3',
            borderWidth: 1
          },
          {
            label: 'Dépenses',
            data: response.depenses,
            backgroundColor: '#ed7e31',
            borderColor: '#ed7e31',
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: Math.max(...response.gains,...response.depenses) + 2000,
            title: {
              display: true,
              text: 'Montant en DHs'
            },
            ticks: {
              stepSize: 1500
            },
          },
          x: {
            title: {
              display: true,
              text: 'Mois'
            }
          }
        }
      }
    });
  }
});