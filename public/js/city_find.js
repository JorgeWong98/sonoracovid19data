const button = document.getElementById('btn_find_city');
let city_id = 0;

var availableTags = [
    "Nogales",
    "Hermosillo",
    "Cajeme",
    "Guaymas",
    "Empalme"
];

let tags = $( "#tags" );

tags.autocomplete({
    source: availableTags,
    change: function( event, ui ) {
        if (ui['item']) {
            city_id = ui['item']['label'];
        }
        else{
            city_id = '0';
        }
    }
});

button.addEventListener('click', (event) => {
    event.preventDefault();
    if (typeof availableTags[city_id] === 'undefined') {
        window.location.href = '/ciudades/' + city_id;
    }
    else{
        $('#myModal').modal('show');
    }
})
