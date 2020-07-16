var ctx = document.getElementById('chartLine').getContext('2d');

const selectPeriod = document.getElementById('period');
const selectCity = document.getElementById('city_id');
let period_value = selectPeriod.value, city_value = selectCity.value;

fetchAsync(`${URL_API}/${selectCity.value}/data?lastDays=${selectPeriod.value}`)
    .then(data => {
        updateChartOne(data);
    });

selectPeriod.addEventListener('change', (event) => {
    fetchAsync(`${URL_API}/${selectCity.value}/data?lastDays=${selectPeriod.value}`)
        .then(data => {
            clearCanvas();
            updateChartOne(data)
        });
})

selectCity.addEventListener('change', (event) => {
    fetchAsync(`${URL_API}/${selectCity.value}/data?lastDays=${selectPeriod.value}`)
        .then(data => {
            clearCanvas();
            updateChartOne(data)
        });
})

const updateChartOne = (data) => {
    let infections = [], deaths = [], dates = [];
    data.registries.forEach(registry => {
        infections.push(registry.infections);
        deaths.push(registry.deaths);
        dates.push(dateFormat(registry.date));
    });

    infections = infections.reverse();
    deaths = deaths.reverse();
    dates = dates.reverse();

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Defunciones',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: deaths
            },
            {
                label: 'Casos',
                backgroundColor: 'rgb(70, 85, 132)',
                borderColor: 'rgb(70, 85, 132)',
                data: infections
            },

            ]
        },
        options :  {
            scales: {
                xAxes: [{
                    afterTickToLabelConversion: function(data){
                        var xLabels = data.ticks;
                        const number = Math.round(xLabels.length / 3);
                        if (xLabels.length > 14) {
                            xLabels.forEach(function (labels, i) {
                                if (i != 0 && i != xLabels.length - 1) {
                                    if (i % number != 0){
                                        // console.log(`${i}/${number} = ${i%number}`);
                                        xLabels[i] = '';
                                    }
                                }
                            });
                        }
                    },
                    ticks: {
                        // Make labels vertical
                        // https://stackoverflow.com/questions/28031873/make-x-label-horizontal-in-chartjs
                        autoSkip: false,
                    maxRotation: 0,
                    minRotation: 0
                      }
                }]
            }
        }
    });
}
