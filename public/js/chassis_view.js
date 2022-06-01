//Table
$(document).ready( function () {
    $('#chassis_table').DataTable({
        columnDefs: [{ type: 'date-uk', targets: 0 }],
        "searching": false,
        paging: false,
        "info": false
    });
});

//Search Box
$(document).ready(function() {

    $("#search_input").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        let rows = document.getElementById("chassis_table").rows;
        let rows_shown = 0;
        for(let i = 1; i < rows.length; i++) {
            if(rows[i].style.display !== "none") {
                rows_shown++;
            }
        }
        document.getElementById("count_div_text").innerHTML = rows_shown + " van " + (rows.length - 1) + " chassis weergegeven";
    });

});

//Information popovers
$('#icon_i').popover({
    trigger: 'hover',
    content: 'Het laden van de webpagina kan momenteel nog lang duren.'
});
$('#th0').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Huidige datum gepland af in montage (datum formaat = dd/mm/yy)'
});
$('#th1').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'De constructienummer'
});
$('#th2').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Omschrijving van het wagentype'
});
$('#th3').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Naam van de klant'
});
$('#th4').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Reekshoofd'
});
$('#th5').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Indien hier “y” staat gaat het om een gegalvaniseerde wagen, "m" voor een gemetalliseerde wagen'
});
$('#th6').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal dagen tussen de huidige dag en de geplande dag (negatief aantal betekend dat geplande datum gepaseerd is)'
});
$('#th7').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal werkdagen dat de wagen reeds in de montage staat (= het verschil in werkdagen tussen de huidige dag en de dag waarop fase 4 opzetten is afgemeld)'
});

//Functions
function showHideRow(row) {
    //$("#secondary_" + row).toggle();
}
