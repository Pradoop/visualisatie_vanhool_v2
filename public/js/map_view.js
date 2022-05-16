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

    for(let i = 1; i < ChassisInMontage_lines.length; i++) {

        //Split the current line
        let line = ChassisInMontage_lines[i].toString().split(/\t/);
        let id = line[0].trim();
        let position = line[17].trim();

        //Check ChassisInKaliberIV file
        for(let j = 1; j < ChassisInKaliberIV_lines.length; j++) {
            let line_compare = ChassisInKaliberIV_lines[j].toString().split(/\t/);
            if(line_compare[0].trim() === id) {
                position = line_compare[2];
            }
        }

        //Make a dot
        let dot = document.createElement('span');
        dot.setAttribute('id', id);
        dot.setAttribute('class', 'dot');
        document.getElementById('image_div').appendChild(dot);

        //popover
        let titles = ChassisInMontage_lines[0].toString().split(/\t/);
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
                titles[9] + ': ' + line[9] + '\n' +
                titles[10] + ': ' + line[10] + '\n' +
                titles[11] + ': ' + line[11] + '\n' +
                titles[12] + ': ' + line[12] + '\n' +
                titles[13] + ': ' + line[13] + '\n' +
                titles[14] + ': ' + line[14] + '\n' +
                titles[15] + ': ' + line[15] + '\n' +
                titles[16] + ': ' + line[16] + '\n' +
                titles[17] + ': ' + line[17] + '\n' +
                titles[18] + ': ' + line[18] + '\n'
        });

        //place the dot
        placeDot(id, position);
    }

});

function placeDot(id, position) {

    //Put it on the right place
    document.getElementById(id).style.position = 'absolute';
    switch(position) {
        //Kalibers
        case "Kal S01  ":
            document.getElementById(id).style.bottom = '11%';
            document.getElementById(id).style.left = '24%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S02  ":
            document.getElementById(id).style.bottom = '11%';
            document.getElementById(id).style.left = '32%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S03  ":
            document.getElementById(id).style.bottom = '11%';
            document.getElementById(id).style.left = '40%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S04  ":
            document.getElementById(id).style.bottom = '11%';
            document.getElementById(id).style.left = '46.9%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S05  ":
            document.getElementById(id).style.bottom = '35%';
            document.getElementById(id).style.left = '32%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S06  ":
            document.getElementById(id).style.bottom = '35%';
            document.getElementById(id).style.left = '40%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S07  ":
            document.getElementById(id).style.top = '37%';
            document.getElementById(id).style.left = '45.75%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S08  ":
            document.getElementById(id).style.top = '12%';
            document.getElementById(id).style.left = '45.75%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S09  "://TODO : correct location
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '4.5%';
            document.getElementById(id).style.backgroundColor = 'red';
            break;
        case "Kal S10  ":
            document.getElementById(id).style.top = '12%';
            document.getElementById(id).style.right = '39%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S11  ":
            document.getElementById(id).style.top = '12%';
            document.getElementById(id).style.right = '44.5%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L01  ":
            document.getElementById(id).style.bottom = '42%';
            document.getElementById(id).style.right = '43%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L02  ":
            document.getElementById(id).style.bottom = '42%';
            document.getElementById(id).style.right = '33.5%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L03  ":
            document.getElementById(id).style.bottom = '42%';
            document.getElementById(id).style.right = '14%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L04  "://TODO : correct location
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '4.5%';
            document.getElementById(id).style.backgroundColor = 'red';
            break;
        case "Kal L05  ":
            document.getElementById(id).style.top = '4.5%';
            document.getElementById(id).style.right = '23%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L06  ":
            document.getElementById(id).style.top = '4.5%';
            document.getElementById(id).style.right = '14.5%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L07  ":
            document.getElementById(id).style.bottom = '7%';
            document.getElementById(id).style.right = '4.5%';
            document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        //Buffers
        case "-":
            document.getElementById(id).style.bottom = '35%';
            document.getElementById(id).style.left = '46.9%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "0":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '44.5%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "1":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '37.5%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "2":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '31%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "3":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '25%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "4":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '20.25%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "5":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '15.25%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "6":
            document.getElementById(id).style.bottom = '26%';
            document.getElementById(id).style.right = '10.5%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "7":
            document.getElementById(id).style.top = '22%';
            document.getElementById(id).style.right = '23.5%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "8":
            document.getElementById(id).style.top = '22%';
            document.getElementById(id).style.right = '17%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        case "9":
            document.getElementById(id).style.top = '22%';
            document.getElementById(id).style.right = '10.5%';
            document.getElementById(id).style.backgroundColor = 'orange';
            break;
        //Default
        default :
            document.getElementById(id).style.top = '22%';
            document.getElementById(id).style.right = '3.5%';
            document.getElementById(id).style.backgroundColor = 'red';
    }
}

function focusDot(line_nr) {

    if(focus_dot !== line_nr) {
        focus = 0;
        focus_dot = line_nr;
    }

    if(focus === 0) {
        for(let i = 1; i < ChassisInMontage_lines.length; i++) {
            let line = ChassisInMontage_lines[i].toString().split(/\t/);
            if(line_nr === i) {
                document.getElementById(line[0].trim()).style.display = 'block';
            }
            else {
                document.getElementById(line[0].trim()).style.display = 'none';
            }
            focus = 1;
        }
    }
    else {
        for(let i = 1; i < ChassisInMontage_lines.length; i++) {
            let line = ChassisInMontage_lines[i].toString().split(/\t/);
            document.getElementById(line[0].trim()).style.display = 'block';
        }
        focus = 0;
    }

}
