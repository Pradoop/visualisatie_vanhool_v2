let rendement_data = [];

$.ajax({
    url: BASE_URL + '/AnalyzeController/getCurrentRendementData',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        for(let i = 0; i < responseObject.length; i++) {
            rendement_data.push(responseObject[i]);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(){
        createTableRendement(rendement_data,'current-rendement-table', 'Rendementen van opleggers in montage');
    }
});

function createTableRendement(my_data, my_table_id, my_title) {

    let table_title = document.getElementById(my_table_id + "-title");
    table_title.innerHTML = my_title;

    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    table.appendChild(thead);
    table.appendChild(tbody);

    let row_1 = document.createElement('tr');
    let heading_1 = document.createElement('th');
    let heading_2 = document.createElement('th');
    let heading_3 = document.createElement('th');
    let heading_4 = document.createElement('th');
    let heading_5 = document.createElement('th');
    let heading_6 = document.createElement('th');
    let heading_extra = document.createElement('th');

    heading_1.innerHTML = "Wagennr";
    heading_2.innerHTML = "Kaliber";
    heading_3.innerHTML = "Gewerkte uren";
    heading_4.innerHTML = "Geplande uren";
    heading_extra.innerHTML = "Verschil uren"
    heading_5.innerHTML = "Klantnaam";
    heading_6.innerHTML = "WagenType";

    row_1.appendChild(heading_1);
    row_1.appendChild(heading_2);
    row_1.appendChild(heading_3);
    row_1.appendChild(heading_4);
    row_1.appendChild(heading_extra);
    row_1.appendChild(heading_5);
    row_1.appendChild(heading_6);
    thead.appendChild(row_1);


    // Adding the entire table to the body tag
    document.getElementById(my_table_id).appendChild(table);
    for (let i =0;  i < my_data.length; i++){
        let temp_chassis = my_data[i];
        let row_wagennr, row_kaliber, row_gewerkt, row_gepland, row_verschil, row_klantnaam, row_wagentype;
        let new_row = document.createElement('tr');
        for (let j = 0; j < temp_chassis.length; j++){
            row_wagennr = document.createElement('td');
            row_kaliber = document.createElement('td');
            row_gewerkt = document.createElement('td');
            row_gepland = document.createElement('td');
            row_verschil = document.createElement('td');
            row_klantnaam = document.createElement('td');
            row_wagentype = document.createElement('td');

            row_wagennr.innerHTML = temp_chassis[0];
            row_kaliber.innerHTML = temp_chassis[1]
            row_gewerkt.innerHTML = temp_chassis[2];
            row_gepland.innerHTML = temp_chassis[3];
            row_verschil.innerHTML = temp_chassis[4]
            row_klantnaam.innerHTML = temp_chassis[5];
            row_wagentype.innerHTML = temp_chassis[6];

        }
        new_row.appendChild(row_wagennr);
        new_row.appendChild(row_kaliber);
        new_row.appendChild(row_gewerkt);
        new_row.appendChild(row_gepland);
        new_row.appendChild(row_verschil);
        new_row.appendChild(row_klantnaam);
        new_row.appendChild(row_wagentype);
        tbody.appendChild(new_row);
    }

}