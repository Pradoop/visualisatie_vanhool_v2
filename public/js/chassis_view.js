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

//Colors for galva
$(document).ready(function(){
    for(let i = 1; i < galva_lines.length; i++) {
        if(galva_lines[i][12] === "y" || galva_lines[i][12] === "m") {
            document.getElementById('primary_'+ (i-1)).style.background = 'green';
        }
    }
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
    content: 'Omschrijving van het wagentype + nummer'
});
$('#th2').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Klant naam + nummer'
});
$('#th3').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Reekshoofd'
});
$('#th4').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Huidige datum gepland af in montage (datum formaat = jjmmdd)'
});
$('#th5').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal dagen tussen de huidige dag en de geplande dag (negatief aantal betekend dat geplande datum gepaseerd is)'
});
$('#th6').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal werkdagen dat de wagen reeds in de montage staat (= het verschil in werkdagen tussen de huidige dag en de dag waarop fase 4 opzetten is afgemeld)'
});

//Functions
function showHideRow(row) {
    //$("#secondary_" + row).toggle();
}
