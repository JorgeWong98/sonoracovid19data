function dateFormat(date) {
    const months = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic']
    elements = date.split('-');
    return `${elements[2]}-${months[elements[1] - 1]}`;
}

function clearCanvas(){
    const container_parent = $("#chartLine").parent();
    $('#chartLine').remove();
    container_parent.append('<canvas id="chartLine"><canvas>');
    canvas = document.querySelector('#chartLine');
    ctx = canvas.getContext('2d');
};

async function fetchAsync (URL_API) {
    let response = await fetch(`${URL_API}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    });
    return await response.json();
}
