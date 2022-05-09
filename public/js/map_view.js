//Enable tooltip
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

//Enable Popover
let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})

//Variables
let focus = 0;
let focus_dot = -1;

//Functions
$(document).ready(function() {

    for(let i = 1; i < file_lines.length - 1; i++) {

        //Split the current line
        let line = file_lines[i].toString().split(/\t/);
        let id = line[0].trim();

        //Make a dot
        let dot = document.createElement('span');
        dot.setAttribute('id', id);
        dot.setAttribute('class', 'dot');
        document.getElementById('image_div').appendChild(dot);

        //popover
        let titles = file_titles.split(/\t/);
        $('#' + id).popover({
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

        document.getElementById(id).style.position = 'absolute';

        //Put it on the right place
        switch(line[2]) {
            case "Kal S01  ":
                document.getElementById(id).style.bottom = '10%';
                document.getElementById(id).style.left = '24%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S02  ":
                document.getElementById(id).style.bottom = '10%';
                document.getElementById(id).style.left = '32%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S03  ":
                document.getElementById(id).style.bottom = '10%';
                document.getElementById(id).style.left = '40%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S04  ":
                document.getElementById(id).style.bottom = '10%';
                document.getElementById(id).style.left = '46.9%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S05  ":
                document.getElementById(id).style.bottom = '35%';
                document.getElementById(id).style.left = '32%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S06  ":
                document.getElementById(id).style.bottom = '35%';
                document.getElementById(id).style.left = '40%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S07  ":
                document.getElementById(id).style.bottom = '59%';
                document.getElementById(id).style.left = '45.75%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S08  ":
                document.getElementById(id).style.bottom = '83%';
                document.getElementById(id).style.left = '45.75%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S09  "://TODO : correct location
                document.getElementById(id).style.bottom = '50%';
                document.getElementById(id).style.left = '50%';
                document.getElementById(line[0]).style.backgroundColor = 'red';
                break;
            case "Kal S10  ":
                document.getElementById(id).style.bottom = '83%';
                document.getElementById(id).style.left = '60.25%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal S11  ":
                document.getElementById(id).style.bottom = '83%';
                document.getElementById(id).style.left = '54.75%';
                document.getElementById(id).style.backgroundColor = 'green';
                break;
            case "Kal L01  ":
                document.getElementById(id).style.bottom = '41%';
                document.getElementById(id).style.left = '56.5%';
                document.getElementById(id).style.backgroundColor = 'yellow';
                break;
            case "Kal L02  ":
                document.getElementById(id).style.bottom = '41%';
                document.getElementById(id).style.left = '66%';
                document.getElementById(id).style.backgroundColor = 'yellow';
                break;
            case "Kal L03  ":
                document.getElementById(id).style.bottom = '41%';
                document.getElementById(id).style.left = '85%';
                document.getElementById(id).style.backgroundColor = 'yellow';
                break;
            case "Kal L04  "://TODO : correct location
                document.getElementById(id).style.bottom = '50%';
                document.getElementById(id).style.left = '50%';
                document.getElementById(line[0]).style.backgroundColor = 'red';
                break;
            case "Kal L05  ":
                document.getElementById(id).style.bottom = '90%';
                document.getElementById(id).style.left = '76.25%';
                document.getElementById(id).style.backgroundColor = 'yellow';
                break;
            case "Kal L06  ":
                document.getElementById(id).style.bottom = '90%';
                document.getElementById(id).style.left = '85%';
                document.getElementById(id).style.backgroundColor = 'yellow';
                break;
            case "Kal L07  ":
                document.getElementById(id).style.bottom = '7%';
                document.getElementById(id).style.left = '94.5%';
                document.getElementById(id).style.backgroundColor = 'yellow';
        }

    }
});

function focusDot(line_nr) {

    if(focus_dot !== line_nr) {
        focus = 0;
        focus_dot = line_nr;
    }

    if(focus === 0) {
        for(let i = 1; i < file_lines.length - 1; i++) {
            let line = file_lines[i].toString().split(/\t/);
            if(line_nr === i) {
                document.getElementById('chassis_' + i).style.color = '#10395d';
                document.getElementById(line[0].trim()).style.display = 'block';
            }
            else {
                document.getElementById('chassis_' + i).style.color = 'var(--bs-body-color)';
                document.getElementById(line[0].trim()).style.display = 'none';
            }
        }
        focus = 1;
    }
    else {
        for(let i = 1; i < file_lines.length - 1; i++) {
            let line = file_lines[i].toString().split(/\t/);
            document.getElementById('chassis_' + i).style.color = 'var(--bs-body-color)';
            document.getElementById(line[0].trim()).style.display = 'block';
        }
        focus = 0;
    }
}
