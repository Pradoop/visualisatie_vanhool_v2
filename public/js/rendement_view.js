$(document).ready(function() {

    $('#chassis_table').DataTable({
        autoWidth: false,
        columnDefs: [
            { type: 'date-uk', targets: 10 },
            { type: 'date-uk', targets: 11 },
            { type: 'percent', targets: 0 }
        ],
        "language": {"url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/nl-NL.json"},
        "searching": false,
        paging: false,
        "info": false,
        "fnInitComplete": function () {
            $(".inspect-data-loading").hide();
            $("#table_content").show();
        }
    });

});

//Information popovers
$('#th0').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'De verhouding gewerkte uren vs geplande uren in percentage.'
});
$('#th1').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal gepresteerde uren tot dusver.'
});
$('#th2').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het aantal geplande uren voor deze chassis.'
});
$('#th3').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Constructienummer.'
});
$('#th4').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Huidige kaliber van de wagen.'
});
$('#th5').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'De naam van de klant.'
});
$('#th6').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Omschrijving van het wagentype.'
});
$('#th7').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Constructienummer van begin van de reeks.'
});
$('#th8').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Constructienummer van einde van de reeks.'
});
$('#th9').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Het land van de klant.'
});
$('#th10').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Datum waarop wagen gestart is in montage. Formaat: dd/mm/yy.'
});
$('#th11').popover({
    trigger: 'hover',
    placement: 'top',
    content: 'Datum waarop wagen uit montage kwam. Formaat: dd/mm/yy.'
});
