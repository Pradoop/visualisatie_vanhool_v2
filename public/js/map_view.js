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

//Functions
$(document).ready(function() {
    for(let i = 1; i < file_lines.length - 1; i++) {

        //Split the current line
        let line = file_lines[i].toString().split(/\t/);

        //Make a dot
        let dot = document.createElement('span');
        dot.setAttribute('id', line[0]);
        dot.setAttribute('class', 'dot');
        document.getElementById('map_div').appendChild(dot);

        //Put it on the right place
        if(line[2] === "Kal S01  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '320px';
            document.getElementById(line[0]).style.left = '340px';
        }
        else if(line[2] === "Kal S02  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '320px';
            document.getElementById(line[0]).style.left = '455px';
        }
        else if(line[2] === "Kal S03  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '320px';
            document.getElementById(line[0]).style.left = '570px';
        }
        else if(line[2] === "Kal S04  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '320px';
            document.getElementById(line[0]).style.left = '665px';
        }
        else if(line[2] === "Kal S05  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '245px';
            document.getElementById(line[0]).style.left = '455px';
        }
        else if(line[2] === "Kal S06  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '245px';
            document.getElementById(line[0]).style.left = '570px';
        }
        else if(line[2] === "Kal S07  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '165px';
            document.getElementById(line[0]).style.left = '650px';
        }
        else if(line[2] === "Kal S08  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '650px';
        }
        else if(line[2] === "Kal S09  ") {

        }
        else if(line[2] === "Kal S10  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '860px';
        }
        else if(line[2] === "Kal S11  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '780px';
        }

        //TODO : zet juiste locatie (nu dummy)
        else if(line[2] === "Kal L01  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }
        else if(line[2] === "Kal L02  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }
        else if(line[2] === "Kal L03  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }
        else if(line[2] === "Kal L04  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }
        else if(line[2] === "Kal L05  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }
        else if(line[2] === "Kal L06  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }
        else if(line[2] === "Kal L07  ") {
            document.getElementById(line[0]).style.position = 'absolute';
            document.getElementById(line[0]).style.top = '90px';
            document.getElementById(line[0]).style.left = '50px';
        }

    }
});

//Generate popover
for(let i = 1; i < file_lines.length; i++) {

    let titles = file_titles.split(/\t/);
    let line = file_lines[i].toString().split(/\t/);

    $('#chassis_' + i).popover({
        trigger: 'click',
        title: titles[0] + ': ' + line[0],
        content: titles[1] + ': ' + line[1] + '\n' +
            titles[2] + ': ' + line[2] + '\n' +
            titles[3] + ': ' + line[3] + '\n' +
            titles[4] + ': ' + line[4] + '\n' +
            titles[5] + ': ' + line[5] + '\n' +
            titles[6] + ': ' + line[6] + '\n' +
            titles[7] + ': ' + line[7] + '\n' +
            titles[8] + ': ' + line[8] + '\n' +
            titles[9] + ': ' + line[9] + '\n'
    });
}
