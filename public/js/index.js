var ctx = document.getElementById('chartBar').getContext('2d');

const fetchAsyncMulti = async (urls) => {
    return await Promise.all(urls.map(u=>fetchAsync(u))).then(responses =>
        Promise.all(responses.map(res => res))
    )
}

fetchAsync(`${URL_API}?orderBy=infections`)
    .then(cities => {
        let urls = [];
        cities.forEach(city => {
            urls.push(`${URL_API}/${city.id}/accumulated`);
        });

        fetchAsyncMulti(urls)
            .then(response => {
                let myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.map(({ name }) => name),
                        datasets: [
                            {
                                label: "Casos",
                                backgroundColor: 'rgb(70, 85, 132)',
                                borderColor: 'rgb(70, 85, 132)',
                                data: response.map(({ infections }) => infections)
                            },
                            {
                                label: "Defunciones",
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: response.map(({ deaths }) => deaths)
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

            })
    })
