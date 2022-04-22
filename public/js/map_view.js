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
        title: chassis_info[0][0] + ': ' + chassis_info[i][0],
        content: chassis_info[0][1] + ': ' + chassis_info[i][1] + '\n' +
            chassis_info[0][2] + ': ' + chassis_info[i][2] + '\n' +
            chassis_info[0][3] + ': ' + chassis_info[i][3] + '\n' +
            chassis_info[0][4] + ': ' + chassis_info[i][4] + '\n' +
            chassis_info[0][5] + ': ' + chassis_info[i][5] + '\n' +
            chassis_info[0][6] + ': ' + chassis_info[i][6] + '\n' +
            chassis_info[0][7] + ': ' + chassis_info[i][7] + '\n' +
            chassis_info[0][8] + ': ' + chassis_info[i][8] + '\n' +
            chassis_info[0][9] + ': ' + chassis_info[i][9] + '\n' +
            chassis_info[0][10] + ': ' + chassis_info[i][10] + '\n' +
            chassis_info[0][11] + ': ' + chassis_info[i][11] + '\n' +
            chassis_info[0][12] + ': ' + chassis_info[i][12] + '\n' +
            chassis_info[0][13] + ': ' + chassis_info[i][13] + '\n' +
            chassis_info[0][14] + ': ' + chassis_info[i][14] + '\n' +
            chassis_info[0][15] + ': ' + chassis_info[i][15] + '\n' +
            chassis_info[0][16] + ': ' + chassis_info[i][16] + '\n' +
            chassis_info[0][17] + ': ' + chassis_info[i][17] + '\n' +
            chassis_info[0][18] + ': ' + chassis_info[i][18] + '\n'
    });
}
