var ctx = document.getElementById('chartBar').getContext('2d');
const spinner = document.getElementById('spinner');

const fetchAsyncMulti = async (urls) => {
    return await Promise.all(urls.map(u=>fetchAsync(u))).then(responses =>
        Promise.all(responses.map(res => res))
    )
}

let urls = cities.map((city) => {
    return `${URL_API}/${city.id}/accumulated`;
});

fetchAsyncMulti(urls)
    .then(response => {
        spinner.style.display = 'none';
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
                    }],
                }
            }
        });
    })

// Sort table

const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

document.querySelectorAll('.sortable-table th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tbody tr'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.querySelector('tbody').appendChild(tr) );
})));
