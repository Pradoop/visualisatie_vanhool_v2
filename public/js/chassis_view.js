//Table
$(document).ready( function () {
    $('#chassis_table').DataTable({
        "searching": false,
        paging: false,
        "info": false
    });
});

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
