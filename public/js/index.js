var ctx = document.getElementById('chartBar').getContext('2d');

cities.forEach(city => {
    const sumInfections = city.registries.reduce(function(total, registry) {
        return total + registry.infections;
    }, 0);
    const sumDeaths = city.registries.reduce(function(total, registry) {
        return total + registry.deaths;
    }, 0);
    city['totalInfections'] = sumInfections;
    city['totalDeaths'] = sumDeaths;
});


var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: cities.map(({ name }) => name),
        datasets: [
            {
                label: "Infectados",
                backgroundColor: 'rgb(70, 85, 132)',
                borderColor: 'rgb(70, 85, 132)',
                data: cities.map(({ infections }) => infections)
            },
            {
                label: "Defunciones",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: cities.map(({ deaths }) => deaths)
            }
        ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            min: 0
          }
        }]
      }
    }
});
