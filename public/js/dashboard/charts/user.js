const vehiculesChart = document.getElementById('vehiculesChart').getContext('2d');
const paidUnpaidContratsChart = document.getElementById('paidUnpaidContratsChart').getContext('2d');
const userReservationsContratsChart = document.getElementById('userReservationsContratsChart').getContext('2d');

$.ajax({
  type: "GET",
  url: '/vehicule-chart',
  success: function (response) {
    new Chart(vehiculesChart, {
      type: 'pie',
      data: {
        labels: response.labels,
        datasets: [{
          label: 'nombre de véhicules',
          data: response.data,
          backgroundColor: [
            '#d50000',
            '#2e7d32',
            '#ff6d00'
          ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'la charte des véhicules',
            position: 'bottom',
            color: 'black'
          }
        },
      },
      
    }); 
  }
});

$.ajax({
  type: "GET",
  url: '/status-contarts',
  success: function (response) {
    new Chart(paidUnpaidContratsChart, {
      type: 'doughnut',
      data: {
        labels: response.labels,
        datasets: [{
          label: 'nombre de contrats',
          data: response.data,
          backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)',
          ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'la charte des contrats',
            position: 'bottom',
            color: 'black'
          }
        },
      },
      
    }); 
  }
});

$.ajax({
  type: "GET",
  url: "/user-reservations-contrats-chart",
  success: function (response) {
    new Chart(userReservationsContratsChart, {
      type: 'line',
      data: {
        labels: response.labels,
        datasets: [
          {
            label: 'Reservations',
            data: response.reservations,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1
          },
          {
            label: 'Contracts',
            data: response.contracts,
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
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
            max: Math.max(...response.contracts,...response.reservations) + 5,
            ticks: {
              stepSize: 1
            },
            title: {
              display: true,
              text: 'Nombre'
            }
          },
          x: {
            beginAtZero: false,
            ticks: {
              stepSize: 1
            },
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

