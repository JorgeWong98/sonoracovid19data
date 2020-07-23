const button = document.getElementById('btn_find_city');
let city_id = 0;

let cities_name = cities.map((city, index, array) => {
    return city.name;
});

$( "#tags" ).autocomplete({
    source: cities_name,
    change: function( event, ui ) {
        if (ui['item']) {
            city_id = ui['item']['label'];
        }
        else{
            city_id = '0';
        }
    }
});

$.ui.autocomplete.filter = function (array, term) {
    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
    return $.grep(array, function (value) {
        return matcher.test(value.label || value.value || value);
    });
};

button.addEventListener('click', (event) => {
    event.preventDefault();
    if (typeof cities_name[city_id] === 'undefined') {
        window.location.href = '/ciudades/' + city_id;
    }
    else{
        $('#myModal').modal('show');
    }
})
