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
let ChassisInKaliberIV_lines = [];
let wachtkamer_dot_top = 15;
let wachtkamer_dot_left = 2;
let buffer_dot_top = 21;
let buffer_dot_right = 47;

//I-icons
$('#wachtkamer_i').popover({
    trigger: 'hover',
    content: 'Dit zijn wagens met de fase "Basisseriepoeg en prefab klaar voor montage". Deze hebben geen locatie beschikbaar.'
});
$('#buffer_i').popover({
    trigger: 'hover',
    content: 'Dit zijn wagens die gestart zijn in montage en niet in een samenstelkaliber liggen. Deze hebben geen locatie beschikbaar.'
});

//Ajax for arrays
$.ajax({
    url: BASE_URL + '/MapController/getChassisMap',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        for(let i = 0; i < responseObject[0].length; i++) {
            chassisInMontage_lines.push(responseObject[0][i]);
        }
        for(let j = 0; j < responseObject[1].length; j++) {
            chassisInWachtkamer.push(responseObject[1][j]);
        }
        for(let k = 0; k < responseObject[2].length; k++) {
            ChassisInKaliberIV_lines.push(responseObject[2][k]);
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

    let max = 0;
    let min = 999;

    for(let i = 0; i < chassisInMontage_lines.length; i++) {

        //Split the current line
        let line = chassisInMontage_lines[i].split(/\t/);
        let id = line[0].trim();

        //Max and min
        if(parseInt(line[17].trim()) < min) {
            min = parseInt(line[17].trim());
        }
        if(parseInt(line[17].trim()) > max) {
            max = parseInt(line[17].trim());
        }

        //create p
        let p = document.createElement('p');
        p.setAttribute('id', 'chassis_' + i);
        p.setAttribute('onclick', "focusDot(" + i + ")");
        p.innerHTML = id;
        document.getElementById('list_chassis').appendChild(p);
    }

    let montage_limit = document.getElementById("dagen_montage_limit");
    montage_limit.min = min;
    montage_limit.max = max;
    montage_limit.value = min;
}

document.getElementById("dagen_montage_limit").addEventListener('change', function() {

    for(let i = 0; i < chassisInMontage_lines.length; i++) {

        //Split the current line
        let line = chassisInMontage_lines[i].split(/\t/);
        let dagenInMontage = parseInt(line[17].trim());

        if(document.getElementById("dagen_montage_limit").value <= dagenInMontage) {
            document.getElementById("chassis_" + i).style.display = "block";
        }
        else {
            document.getElementById("chassis_" + i).style.display = "none";
        }
    }
})

function createDot(chassis_array) {

    for(let i = 0; i < chassis_array.length; i++) {

        let className = "dot_wachtkamer";

        //Split the current line
        let line = chassis_array[i].split(/\t/);
        let id = line[0].trim();
        let position = line[17].trim();

        //Check if in hal 5 or hal 6
        if(position !== "") {
            className = "dot_buffer";
        }

        //Check ChassisInKaliberIV file
        for(let j = 1; j < ChassisInKaliberIV_lines.length; j++) {
            let line_compare = ChassisInKaliberIV_lines[j].toString().split(/\t/);
            if(line_compare[0].trim() === id) {
                if(line_compare[2].includes("S")) {
                    className = "dot_K_kaliber";
                }
                else {
                    className = "dot_L_kaliber";
                }
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

        //Update number legend
        let aantalWachtkamer = document.getElementsByClassName("dot_wachtkamer").length - 1;
        document.getElementById("aantalWachtkamer").innerHTML = "Aantal wagens in wachtkamer: " + aantalWachtkamer;
        let aantalBuffer = document.getElementsByClassName("dot_buffer").length - 1;
        document.getElementById("aantalBuffer").innerHTML = "Aantal wagens in bufferzones: " + aantalBuffer;
        let aantalMontage = document.querySelectorAll(".dot_buffer, .dot_K_kaliber, .dot_L_kaliber").length - 3;
        document.getElementById("aantalMontage").innerHTML = "Aantal wagens in montage: " + aantalMontage;
    }
}

function placeDot(id, position) {

    //Put it on the right place
    document.getElementById(id).style.position = 'absolute';

    //Place
    switch(position) {
        //Kalibers
        case "Kal S01  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '23.25%';
            break;
        case "Kal S02  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '30.75%';
            break;
        case "Kal S03  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '38.25%';
            break;
        case "Kal S04  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.left = '45.75%';
            break;
        case "Kal S05  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.left = '29%';
            break;
        case "Kal S06  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.left = '36.5%';
            break;
        case "Kal S07  ":
            document.getElementById(id).style.top = '40%';
            document.getElementById(id).style.left = '45.75%';
            break;
        case "Kal S08  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.left = '45.75%';
            break;
        case "Kal S10  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '44.5%';
            break;
        case "Kal S11  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '38.5%';
            break;
        case "Kal S12  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '32.5%';
            break;
        case "Kal L01  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.right = '43%';
            break;
        case "Kal L02  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.right = '33.75%';
            break;
        case "Kal L03  ":
            document.getElementById(id).style.bottom = '40%';
            document.getElementById(id).style.right = '14.25%';
            break;
        case "Kal L04  ":
            document.getElementById(id).style.bottom = '8%';
            document.getElementById(id).style.right = '4.5%';
            break;
        case "Kal L05  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '22.25%';
            break;
        case "Kal L06  ":
            document.getElementById(id).style.top = '8%';
            document.getElementById(id).style.right = '13.5%';
            break;
        case "Kal L07  ":
            document.getElementById(id).style.top = '8%'
            document.getElementById(id).style.right = '4.5%';
            break;
        //Wachtkamer
        case "":
            document.getElementById(id).style.top = wachtkamer_dot_top + '%';
            document.getElementById(id).style.left = wachtkamer_dot_left + '%';
            wachtkamer_dot_left = wachtkamer_dot_left + 1;
            if(wachtkamer_dot_left === 17) {
                wachtkamer_dot_left = 2;
                wachtkamer_dot_top = wachtkamer_dot_top + 5;
            }
            break;
        //Buffers
        default :
            document.getElementById(id).style.top = buffer_dot_top + '%';
            document.getElementById(id).style.right = buffer_dot_right + '%';
            buffer_dot_right = buffer_dot_right - 1;
            //Naar begin buffer links onder
            if(buffer_dot_right === 29 && buffer_dot_top === 26) {
                buffer_dot_right = 47;
                buffer_dot_top = 69;
            }
            //Naar begin buffer rechts onder

            if(buffer_dot_right === 0 && buffer_dot_top === 26) {
                buffer_dot_right = 26;
                buffer_dot_top = 69;
            }
            //Naar begin buffer rechts boven
            if(buffer_dot_right === 29 && buffer_dot_top === 74) {
                buffer_dot_right = 26;
                buffer_dot_top = 21;
            }
            //Naar begin buffer links boven
            if(buffer_dot_right === 0 && buffer_dot_top === 74) {
                buffer_dot_right = 47;
                buffer_dot_top = 21;
            }
            //Rij omlaag in 2 linkse buffers
            if(buffer_dot_right === 29) {
                buffer_dot_right = 47;
                buffer_dot_top = buffer_dot_top + 5;
            }
            //Rij omlaag in 2 rechtse buffers
            if(buffer_dot_right === 0) {
                buffer_dot_right = 26;
                buffer_dot_top = buffer_dot_top + 5;
            }
    }
}

$("#search_input").on("keyup", function() {

    let possible_hits = 0;
    let value = $(this).val();

    //List
    $("#important_div p").filter(function() {
        $(this).toggle($(this).text().indexOf(value) > -1);
    });

    let all = chassisInMontage_lines.concat(chassisInWachtkamer);
    for(let i = 0; i < all.length; i++) {
        let line = all[i].split(/\t/);
        let id = line[0].trim();

        if(id.indexOf(value) > -1) {
            document.getElementById(id).style.display = 'block';
            possible_hits++;
        }
        else {
            document.getElementById(id).style.display = 'none';
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

$('#map').click(function() {

    for(let i = 0; i < chassisInWachtkamer.length; i++) {
        let line = chassisInWachtkamer[i].toString().split(/\t/);
        document.getElementById(line[0].trim()).style.display = 'block';
    }
    for(let i = 0; i < chassisInMontage_lines.length; i++) {
        let line = chassisInMontage_lines[i].toString().split(/\t/);
        document.getElementById(line[0].trim()).style.display = 'block';
        let dagenInMontage = parseInt(line[17].trim());
        if(document.getElementById("dagen_montage_limit").value <= dagenInMontage) {
            document.getElementById("chassis_" + i).style.display = 'block';
        }
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
