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
let chassisInMontage_lines = [];
let chassisInWachtkamer = [];

//Ajax for arrays
$.ajax({
    url: BASE_URL + '/MapController/getChassisMap',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        document.getElementById("aantalMontage").innerHTML = "Aantal wagens in montage: " + responseObject[0].length;
        document.getElementById("aantalWachtkamer").innerHTML = "Aantal wagens in wachtkamer: " + responseObject[1].length;
        for(let i = 0; i < responseObject[0].length; i++) {
            chassisInMontage_lines.push(responseObject[0][i]);
        }
        for(let j = 0; j < responseObject[1].length; j++) {
            chassisInWachtkamer.push(responseObject[1][j]);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function() {
        createImportantList();
        createDot(chassisInMontage_lines);
        createDot(chassisInWachtkamer);
    }
});

function createImportantList() {

    let column = 0;
    for(let i = 0; i < chassisInMontage_lines.length; i++) {

        //Split the current line
        let line = chassisInMontage_lines[i].split(/\t/);
        let id = line[0].trim();

        //create p
        let p = document.createElement('p');
        p.setAttribute('id', 'chassis_' + i);
        p.setAttribute('onclick', "focusDot(" + i + ")");
        p.innerHTML = id;
        document.getElementById('column_' + column).appendChild(p);

        column++;
        if(column === 5) {
            column = 0;
        }
    }
}

function createDot(chassis_array) {

    for(let i = 0; i < chassis_array.length; i++) {

        let className = "dot_wachtkamer";

        //Split the current line
        let line = chassis_array[i].split(/\t/);
        let id = line[0].trim();
        let position = line[17].trim();

        //Check if in hal 5 or hal 6
        if(position !== "") {
            className = "dot_buffers";
        }

        //Check ChassisInKaliberIV file
        for(let j = 1; j < ChassisInKaliberIV_lines.length; j++) {
            let line_compare = ChassisInKaliberIV_lines[j].toString().split(/\t/);
            if(line_compare[0].trim() === id) {
                className = "dot_kalibers";
                position = line_compare[2];
            }
        }

        //Make a dot
        let dot = document.createElement('span');
        dot.setAttribute('id', id);
        dot.setAttribute('class', className);
        dot.setAttribute('tabindex', '0');
        document.getElementById('image_div').appendChild(dot);

        //Convert date
        let parts = line[3].match(/.{1,2}/g);
        let new_date = parts[2] + '/' + parts[1] + '/' + parts[0];

        //popover
        $('#' + id).popover({
            trigger: 'focus',
            title: 'Wagen : ' + line[0],
            content:
                'Datum gepland : ' + new_date + '\n' +
                'Wagentype : ' + line[5] + '\n' +
                'Klant : ' + line[7] + '\n' +
                'Land : ' + line[8] + '\n' +
                'Reeks van : ' + line[10] + '\n' +
                'Galva : ' + line[12] + '\n'
        });

        //place the dot
        placeDot(id, position);
    }
}

function placeDot(id, position) {

    //Put it on the right place
    document.getElementById(id).style.position = 'absolute';
    switch(position) {
        //Kalibers
        case "Kal S01  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '23.25%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S02  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '30.75%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S03  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '38.25%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S04  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '45.75%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S05  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.left = '29%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S06  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.left = '36.5%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S07  ":
            document.getElementById(id).style.top = '40%';
            document.getElementById(id).style.left = '45.75%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S08  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.left = '45.75%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S10  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '44.5%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S11  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '38.5%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal S12  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '32.5%';
            //document.getElementById(id).style.backgroundColor = '#10395d';
            break;
        case "Kal L01  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.right = '43%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        case "Kal L02  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.right = '33.75%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        case "Kal L03  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.right = '14.25%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        case "Kal L04  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.right = '4.5%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        case "Kal L05  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '22.25%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        case "Kal L06  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '13.5%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        case "Kal L07  ":
            document.getElementById(id).style.top = '8%'
            document.getElementById(id).style.right = '4.5%';
            document.getElementById(id).style.backgroundColor = 'yellow';
            break;
        //Buffers
        case "-":
            document.getElementById(id).style.top = '23.5%';
            document.getElementById(id).style.right = '38.75%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "0":
            document.getElementById(id).style.top = '23.5%';
            document.getElementById(id).style.right = '31.5%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "1":
            document.getElementById(id).style.bottom = '24%';
            document.getElementById(id).style.right = '38.75%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "2":
            document.getElementById(id).style.bottom = '24%';
            document.getElementById(id).style.right = '31.5%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "3":
            document.getElementById(id).style.bottom = '24%';
            document.getElementById(id).style.right = '25%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "4":
            document.getElementById(id).style.bottom = '24%';
            document.getElementById(id).style.right = '19%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "5":
            document.getElementById(id).style.bottom = '24%';
            document.getElementById(id).style.right = '14%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "6":
            document.getElementById(id).style.bottom = '24%';
            document.getElementById(id).style.right = '9%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "7":
            document.getElementById(id).style.top = '23.5%';
            document.getElementById(id).style.right = '25%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "8":
            document.getElementById(id).style.top = '23.5%';
            document.getElementById(id).style.right = '19%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        case "9":
            document.getElementById(id).style.top = '23.5%';
            document.getElementById(id).style.right = '14%';
            document.getElementById(id).style.backgroundColor = 'purple';
            break;
        //Wachtkamer
        case "" :
            document.getElementById(id).style.top = '15%';
            document.getElementById(id).style.left = '2%';
            break;
        //Default
        default :
            document.getElementById(id).style.bottom = '15%';
            document.getElementById(id).style.left = '2%';
            document.getElementById(id).style.backgroundColor = 'red';
    }
}

$("#search_input").on("keyup", function() {

    let possible_hits = 0;
    let value = $(this).val();
    let dots = document.querySelectorAll(".dot_kalibers, .dot_buffers, .dot_wachtkamer");

    //List
    $("#important_div p").filter(function() {
        $(this).toggle($(this).text().indexOf(value) > -1);
    });

    //Dots
    for(let i = 0; i < dots.length; i++) {
        if(dots[i].id.indexOf(value) > -1) {
            document.getElementById(dots[i].id).style.display = 'block';
            possible_hits++;
        }
        else {
            document.getElementById(dots[i].id).style.display = 'none';
        }
    }

    //Show not found message
    if(possible_hits === 0) {
        document.getElementById("search_failure_div").style.display = "block";
    }
    else {
        document.getElementById("search_failure_div").style.display = "none";
    }
});

//Clicking on map
$('#map').click(function() {
    for(let i = 1; i < chassisInMontage_lines.length; i++) {
        let line = chassisInMontage_lines[i].toString().split(/\t/);
        document.getElementById(line[0].trim()).style.display = 'block';
        document.getElementById("chassis_" + (i-1)).style.display = 'block';
    }
    document.getElementById("search_input").value = "";
    focus = 0;
});

function focusDot(line_nr) {

    let chassis_nr = 0;

    if(focus_dot !== line_nr) {
        focus = 0;
        focus_dot = line_nr;
    }

    if(focus === 0) {
        for(let i = 0; i < chassisInWachtkamer.length; i++) {
            let line = chassisInWachtkamer[i].toString().split(/\t/);
            document.getElementById(line[0].trim()).style.display = 'none';
        }
        for(let i = 0; i < chassisInMontage_lines.length; i++) {
            let line = chassisInMontage_lines[i].toString().split(/\t/);
            if(line_nr === i) {
                chassis_nr = line[0].trim();
                document.getElementById(line[0].trim()).style.display = 'block';
            }
        }
        for(let i = 0; i < chassisInMontage_lines.length; i++) {
            let line = chassisInMontage_lines[i].toString().split(/\t/);
            if(line[0].trim() !== chassis_nr) {
                document.getElementById(line[0].trim()).style.display = 'none';
            }
            focus = 1;
        }
    }
    else {
        for(let i = 0; i < chassisInWachtkamer.length; i++) {
            let line = chassisInWachtkamer[i].toString().split(/\t/);
            document.getElementById(line[0].trim()).style.display = 'block';
        }
        for(let i = 0; i < chassisInMontage_lines.length; i++) {
            let line = chassisInMontage_lines[i].toString().split(/\t/);
            document.getElementById(line[0].trim()).style.display = 'block';
        }
        focus = 0;
    }
}
