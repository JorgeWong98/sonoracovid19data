var ctx = document.getElementById('chartLine').getContext('2d');

const URL_API = "http://127.0.0.1:8000/api/cities";

const updateChartCompare = (data, type) => {
    let city_1 = [], city_2 = [], dates = [];
    type = (type == 0) ? 'infections' : 'deaths';
    for (let index = 0; index < selectPeriodCompare.value; index++) {
        city_1.push(data[0].registries[index][type]);
        city_2.push(data[1].registries[index][type]);
        dates.push(dateFormat(data[0].registries[index].date));
    }

    city_1.reverse();
    city_2.reverse();
    dates.reverse();

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Nogales',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: city_1
            },
            {
                label: 'Hermosillo',
                backgroundColor: 'rgb(70, 85, 132)',
                borderColor: 'rgb(70, 85, 132)',
                data: city_2
            },
            ]
        },
    });
}

const selectPeriodCompare = document.getElementById('period_compare');
const selectTypeCompare = document.getElementById('type_compare');
let urls = [
    `${URL_API}/1/data?lastDays=${selectPeriodCompare.value}`,
    `${URL_API}/2/data?lastDays=${selectPeriodCompare.value}`
]

const fetchAsyncMulti = async (urls) => {
    return await Promise.all(urls.map(u=>fetchAsync(u))).then(responses =>
        Promise.all(responses.map(res => res))
    )
}

fetchAsyncMulti(urls)
    .then(response => {
        updateChartCompare(response, selectTypeCompare.value)
    })

selectPeriodCompare.addEventListener('change', (event) => {
    urls = [
        `${URL_API}/1/data?lastDays=${selectPeriodCompare.value}`,
        `${URL_API}/2/data?lastDays=${selectPeriodCompare.value}`
    ]
    fetchAsyncMulti(urls)
    .then((response) => {
        clearCanvas()
        updateChartCompare(response, selectTypeCompare.value)
    })
})

selectTypeCompare.addEventListener('change', () => {
    urls = [
        `${URL_API}/1/data?lastDays=${selectPeriodCompare.value}`,
        `${URL_API}/2/data?lastDays=${selectPeriodCompare.value}`
    ]
    fetchAsyncMulti(urls)
    .then((response) => {
        clearCanvas()
        updateChartCompare(response, selectTypeCompare.value)
    })
})
