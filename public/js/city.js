var ctx = document.getElementById('chartLine').getContext('2d');

const URL_API = "http://127.0.0.1:8000/api/cities";

const selectPeriod = document.getElementById('period');
const selectCity = document.getElementById('city');
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
                label: 'Contagios',
                backgroundColor: 'rgb(70, 85, 132)',
                borderColor: 'rgb(70, 85, 132)',
                data: infections
            },
            ]
        },
    });
}
