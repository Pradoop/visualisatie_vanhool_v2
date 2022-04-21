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
for(let i = 1; i < chassis_info.length; i++) {
    $('#chassis_' + i).popover({
        trigger: 'click',
        title: 'Chassis: ' + chassis_info[i][1],
        content: 'DLnr: ' + chassis_info[i][2] + '\n' +
            'Kaliber: ' + chassis_info[i][3] + ' ' + chassis_info[i][4] + '\n' +
            'NaamFase: ' + chassis_info[i][5] + '\n' +
            'NaamKlant: ' + chassis_info[i][6] + ' ' + chassis_info[i][7] + ' ' + chassis_info[i][8]  + '\n' +
            'NaamType: ' + chassis_info[i][9] + '\n' +
            'Natie: ' + chassis_info[i][10] + '\n' +
            'StandInProd: ' + chassis_info[i][11] + '\n' +
            'ReeksVan: ' + chassis_info[i][12] + '\n' +
            'ReeksTot: ' + chassis_info[i][13] + '\n'
    });
}
