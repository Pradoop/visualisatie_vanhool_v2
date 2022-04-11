//Enable tooltip
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

//Enable Popover
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})

//Generate popovers
$('#chassis_1').popover({
    trigger: 'click',
    title: 'Chassis: ' + chassis_info[1][1],
    content: 'DLnr: ' + chassis_info[1][2] + '\n' +
        'Kaliber: ' + chassis_info[1][3] + ' ' + chassis_info[1][4] + '\n' +
        'NaamFase: ' + chassis_info[1][5] + '\n' +
        'NaamKlant: ' + chassis_info[1][6] + ' ' + chassis_info[1][7] + ' ' + chassis_info[1][8]  + '\n' +
        'NaamType: ' + chassis_info[1][9] + '\n' +
        'Natie: ' + chassis_info[1][10] + '\n' +
        'StandInProd: ' + chassis_info[1][11] + '\n' +
        'ReeksVan: ' + chassis_info[1][12] + '\n' +
        'ReeksTot: ' + chassis_info[1][13] + '\n'
});