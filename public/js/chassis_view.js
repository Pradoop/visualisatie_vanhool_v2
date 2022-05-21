//Search Box
$(document).ready(function(){
    $("#search_input").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

//Table
$(document).ready( function () {
    $('#chassis_table').DataTable();
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
    content: 'Omschrijving van het wagentype nummer'
});
$('#th3').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Klant naam'
});
$('#th4').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Reekshoofd'
});
$('#th5').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Indien hier “y” staat gaat het om een gegalvaniseerde wagen'
});
$('#th6').popover({
    trigger: 'hover',
    placement: 'top',
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
$('#th7').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Huidige datum gepland af in montage (datum formaat = jjmmdd)'
});
$('#th8').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal werkdagen dat de wagen reeds in de montage staat (= het verschil in werkdagen tussen de huidige dag en de dag waarop fase 4 opzetten is afgemeld)'
});
$('#th9').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal dagen tussen de huidige dag en de geplande dag (Negatief aantal betekend dat geplande datum gepaseerd is'
});
