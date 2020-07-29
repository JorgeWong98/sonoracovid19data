const button = document.getElementById('btn_find_city');
let name_city = 0;

let cities_name = cities.map((city, index, array) => {
    return city.name;
});

let tags = $( "#tags" );

tags.autocomplete({
    source: cities_name,
    select: function (event, ui) {
        name_city = ui['item']['label'];
    }
});

tags.on('keypress', (event) => {
    const currentText = tags[0].value.trim();
    const name = currentText.charAt(0).toUpperCase() + currentText.slice(1).toLowerCase(); //First letter upper and others lower
    if(cities_name.indexOf(name) > -1) {
        name_city = name;
    }
    else{
        name_city = '';
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
    goToCity();
})

const findCity = document.getElementById('find-city');

findCity.addEventListener('keypress', (e) => {
    if(e && e.keyCode == 13) {
        goToCity();
    }
})

const goToCity = () => {
    console.log(name_city);
    if (cities_name.indexOf(name_city) > -1) {
        window.location.href = '/ciudades/' + name_city;
    }
    else{
        $('#myModal').modal('show');
    }
};
