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

//Functions
$(document).ready(function() {

    for(let i = 1; i < file_lines.length - 1; i++) {

        //Split the current line
        let line = file_lines[i].toString().split(/\t/);

        //Make a dot
        let dot = document.createElement('span');
        dot.setAttribute('id', line[0]);
        dot.setAttribute('class', 'dot');
        document.getElementById('image_div').appendChild(dot);

        document.getElementById(line[0]).style.position = 'absolute';

        //Put it on the right place
        switch(line[2]) {
            case "Kal S01  ":
                document.getElementById(line[0]).style.bottom = '10%';
                document.getElementById(line[0]).style.left = '24%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S02  ":
                document.getElementById(line[0]).style.bottom = '10%';
                document.getElementById(line[0]).style.left = '32%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S03  ":
                document.getElementById(line[0]).style.bottom = '10%';
                document.getElementById(line[0]).style.left = '40%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S04  ":
                document.getElementById(line[0]).style.bottom = '10%';
                document.getElementById(line[0]).style.left = '46.9%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S05  ":
                document.getElementById(line[0]).style.bottom = '35%';
                document.getElementById(line[0]).style.left = '32%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S06  ":
                document.getElementById(line[0]).style.bottom = '35%';
                document.getElementById(line[0]).style.left = '40%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S07  ":
                document.getElementById(line[0]).style.bottom = '59%';
                document.getElementById(line[0]).style.left = '45.75%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S08  ":
                document.getElementById(line[0]).style.bottom = '83%';
                document.getElementById(line[0]).style.left = '45.75%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S10  ":
                document.getElementById(line[0]).style.bottom = '83%';
                document.getElementById(line[0]).style.left = '60.25%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal S11  ":
                document.getElementById(line[0]).style.bottom = '83%';
                document.getElementById(line[0]).style.left = '54.75%';
                document.getElementById(line[0]).style.backgroundColor = 'green';
                break;
            case "Kal L01  "://TODO : correct location
                document.getElementById(line[0]).style.bottom = '41%';
                document.getElementById(line[0]).style.left = '56.5%';
                document.getElementById(line[0]).style.backgroundColor = 'yellow';
                break;
            case "Kal L02  "://TODO : correct location
                document.getElementById(line[0]).style.bottom = '41%';
                document.getElementById(line[0]).style.left = '66%';
                document.getElementById(line[0]).style.backgroundColor = 'yellow';
                break;
            case "Kal L03  "://TODO : correct location
                document.getElementById(line[0]).style.bottom = '90%';
                document.getElementById(line[0]).style.left = '76.25%';
                document.getElementById(line[0]).style.backgroundColor = 'yellow';
                break;
            case "Kal L04  "://TODO : correct location

                document.getElementById(line[0]).style.backgroundColor = 'yellow';
                break;
            case "Kal L05  "://TODO : correct location
                document.getElementById(line[0]).style.bottom = '90%';
                document.getElementById(line[0]).style.left = '85%';
                document.getElementById(line[0]).style.backgroundColor = 'yellow';
                break;
            case "Kal L06  "://TODO : correct location
                document.getElementById(line[0]).style.bottom = '41%';
                document.getElementById(line[0]).style.left = '85%';
                document.getElementById(line[0]).style.backgroundColor = 'yellow';
                break;
            case "Kal L07  "://TODO : correct location
                document.getElementById(line[0]).style.bottom = '7%';
                document.getElementById(line[0]).style.left = '94.5%';
                document.getElementById(line[0]).style.backgroundColor = 'yellow';
        }

    }
});

function focusDot(line_nr) {

    for(let i = 1; i < file_lines.length - 1; i++) {

        let line = file_lines[i].toString().split(/\t/);
        if(line_nr === i) {
            document.getElementById(line[0]).style.display = 'block';
        }
        else {
            document.getElementById(line[0]).style.display = 'none';
        }
    }
}

//Generate popover
/*
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

 */
