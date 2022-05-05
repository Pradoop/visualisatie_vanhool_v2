//Variables
let original_table = document.getElementById("chassis_table");
let current_column = -1;
let status = 0;

//Search Box
$(document).ready(function(){
    $("#search_input").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

//Popovers
$('#th0').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'De constructienummer'
});
$('#th1').popover({
    trigger: 'hover',
    placement: 'top',
    content: ' Het aantal wagens dat in de reeks zit waartoe dit wagennummer behoort'
});
$('#th2').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Huidige datum gepland af in montage (datum formaat = jjmmdd)'
});
$('#th3').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Omschrijving van het wagentype nummer'
});
$('#th4').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Klant naam'
});
$('#th5').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Nummer van de productielijn'
});
$('#th6').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Reekshoofd'
});
$('#th7').popover({
    trigger: 'hover',
    placement: 'top',
    title: 'Code met de huidige productiestand',
    content: '01 => Verkocht voertuig' + '\n' +
        '02 => Studie is gestart' + '\n' +
        '20 => Studie chassis is afgewerkt' + '\n' +
        '03 => Studie volledig klaar, klaar voor werkvoorbereiding' + '\n' +
        '04 => Serieploeg is gestart' + '\n' +
        '40 => Prognosedatum prefab is bepaald' + '\n' +
        '39 => Prognosedatum voor basisserie is bepaald' + '\n' +
        '38 => Basisserieploeg en prefab klaar voor montage' + '\n' +
        '07 => Gestart in de samenstelkaliber' + '\n' +
        '83 => Uit de samenstelkaliber' + '\n' +
        '85 => Gestart in de lasrobot' + '\n' +
        '86 => Gestart met aflassen' + '\n' +
        '8  => Morgen af in de montage afdeling' + '\n' +
        '81 => Vandaag af in de montage afdeling' + '\n'
});
$('#th8').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Aantal werkdagen dat de wagen op dit moment voor of achter staat ten opzichte van de contractdatum (= het verschil in werkdagen tussen de contractdatum en de dag waarop fase 13 gepland af is)'
});
$('#th9').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal werkdagen dat de wagen reeds in de montage staat (= het verschil in werkdagen tussen de huidige dag en de dag waarop fase 4 opzetten is afgemeld)'
});

//Functions
function showSortIcons(i) {

    if(current_column !== i) {
        //Remove all
        if(document.getElementById('up_logo') !== null) {
            let remove = document.getElementById('up_logo');
            remove.parentNode.removeChild(remove);
        }
        if(document.getElementById('down_logo') !== null) {
            let remove = document.getElementById('down_logo');
            remove.parentNode.removeChild(remove);
        }
        //Reset variables
        current_column = i;
        status = 0;
    }

    //Change sorting status
    if(status === 0) {//DOWN
        console.log('Column ' + current_column + ' clicked 1 time: ' + status + " (DOWN)");
        let img_down = document.createElement('img');
        img_down.setAttribute('id', 'down_logo');
        img_down.setAttribute('class', 'down_logo');
        img_down.setAttribute('src', BASE_URL + '/images/icons8-down-arrow-15.png');
        img_down.setAttribute('alt', '...');
        document.getElementById('th' + current_column).appendChild(img_down);
        status++;

        sortTable(current_column, 'down');
    }
    else if(status === 1) {//UP
        console.log('Column ' + current_column + ' clicked 2 times: ' + status + " (UP)");
        let remove = document.getElementById('down_logo');
        remove.parentNode.removeChild(remove);
        let img_up = document.createElement('img');
        img_up.setAttribute('id', 'up_logo');
        img_up.setAttribute('class', 'up_logo');
        img_up.setAttribute('src', BASE_URL + '/images/icons8-up-arrow-15.png');
        img_up.setAttribute('alt', '...');
        document.getElementById('th' + current_column).appendChild(img_up);
        status++;

        sortTable(current_column, 'up');
    }
    else {//ORIGINAL
        console.log('Column ' + current_column + ' clicked 3 times: ' + status + " (ORIGINAL)");
        let remove = document.getElementById('up_logo');
        remove.parentNode.removeChild(remove);
        status = 0;

        //TODO : create the original table
    }
}

function sortTable(column, state) {

    let table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("chassis_table");
    switching = true;

    while(switching) {
        switching = false;
        rows = table.rows;

        for(i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[column];
            y = rows[i + 1].getElementsByTagName("TD")[column];

            if(column === 3 || column === 4) {
                if(state === 'up') {
                    if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else if(state === 'down') {
                    if(x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            else {
                if(state === 'up') {
                    if (Number(x.innerHTML) > Number(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else if(state === 'down') {
                    if (Number(x.innerHTML) < Number(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
