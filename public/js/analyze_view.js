const total_welding_data = [];
const chassis_pln_date = [], chassis_table = [];
const stand_las_0 = [], stand_las_1 = [], stand_las_2 = [], stand_las_3 = [], stand_las_4 = [];
/*
 * Changing default options as well for the text in the bars
 */
Chart.register(ChartDataLabels);
Chart.defaults.set('plugins.datalabels', {
    color: 'white',
});
Chart.defaults.font.size = 16;

/*
 * Ajax request to retrieve all the data for welding
 * This call also executes the createWeldingChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/AnalyzeController/getWeldingData',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        let year = "";
        const tempYear = "";
        for(let i = 0; i < responseObject.length; i++) {
            let currentObject = responseObject[i];
            for (let j = 0; j < currentObject.length; j++) {
                if (j % 6 === 1) {
                    const temp = currentObject[j];
                    year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
                    const month = temp.substring(2, 4);
                    const day = temp.substring(4, 6);
                    let date = new Date(year, month - 1, day);
                    date.setHours(0, 0, 0, 0);
                    currentObject[j] = date;
                }
            }
            total_welding_data.push(currentObject);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        for (const i in total_welding_data){
            switch (total_welding_data[i][4]){
                case "L0":
                    stand_las_0.push(total_welding_data[i]);
                    break;
                case "L1":
                    stand_las_1.push(total_welding_data[i]);
                    break;
                case "L2":
                    stand_las_2.push(total_welding_data[i]);
                    break;
                case "L3":
                    stand_las_3.push(total_welding_data[i]);
                    break;
                case "":
                    stand_las_4.push(total_welding_data[i]);

            }
        }
        createWeekWeldingChart(total_welding_data, 2, 'fortnight_welding_chart', 'Chassis per stand las in twee weken');
        createWeekWeldingChart(total_welding_data, 1, 'next_week_welding_chart', 'Chassis per stand las volgende week');
        createWeekWeldingChart(total_welding_data, 0, 'this_week_welding_chart', 'Chassis per stand las deze week');
    }
});

/*
 * Ajax request to retrieve all the dtmGepland
 * This call also executes the createPhaseChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/AnalyzeController/getWeekChartInfo',
    method: "get",
    dataType: 'text',
    success: function(response) {
        let responseObject = JSON.parse(response);
        let year = "";
        const tempYear = "";
        for(let i = 0; i < responseObject.length; i++){
           let currentObject = responseObject[i];
            for (let j = 0;  j< currentObject.length; j++){
                if (j % 3 === 1 ){
                    const temp = currentObject[j];
                    year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
                    const month = temp.substring(2, 4);
                    const day = temp.substring(4, 6);
                    let date = new Date(year, month - 1, day);
                    date.setHours(0, 0, 0, 0);
                    currentObject[j] = date;
                }
            }
            chassis_pln_date.push(currentObject);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createWeekBarChart(chassis_pln_date, 0, 'this_week_chart', "Aantal geplande chassis: deze week");
        createWeekBarChart(chassis_pln_date, 1, 'next_week_chart', "Aantal geplande chassis: volgende week");
        createWeekBarChart(chassis_pln_date, 2, 'fortnight_chart', "Aantal geplande chassis in twee weken");
    }
});

/*
 * Ajax request to retrieve wagennr, dtmGepland, wagTyp en klantNaam
 *
 */
$.ajax({
    url: BASE_URL + '/AnalyzeController/getTableInfoToday',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        let year = "";
        const tempYear = "";
        for(let i = 0; i < responseObject.length; i++){
            let currentObject = responseObject[i];
            for (let j = 0;  j< currentObject.length; j++){
                if (j % 3 === 1 ){
                    const temp = currentObject[j];
                    year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
                    const month = temp.substring(2, 4);
                    const day = temp.substring(4, 6);
                    let date = new Date(year, month - 1, day);
                    date.setHours(0, 0, 0, 0);
                    currentObject[j] = date;
                }
            }
            chassis_table.push(currentObject);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createTableChassisPlanned(chassis_table, new Date(), 'chassis-today-table', 'Chassis gepland vandaag');
    }
});


function calculateWeekNumber(my_date){
    //To calculate week number
    let oneJan = new Date(my_date.getFullYear(), 0, 1);
    let numberOfDays = Math.floor((my_date - oneJan) / (24 * 60 * 60 * 1000));
    return Math.ceil((my_date.getDay() + 1 + numberOfDays) / 7)
}

function createTableChassisPlanned(my_data, my_date, my_table_id, my_title){
    const week_chassis = [[], [], [], [], []];
    let firstDay = my_date;
    firstDay.setHours(0, 0, 0, 0);

    let table_title = document.getElementById(my_table_id + "-title");
    table_title.innerHTML = my_title;

    let secondDay = new Date();
    secondDay.setTime(firstDay.getTime() + 864e5);
    secondDay.setHours(0, 0, 0, 0);
    let thirdDay = new Date();
    thirdDay.setTime(firstDay.getTime() + (2*864e5));
    thirdDay.setHours(0, 0, 0, 0);
    let fourthDay = new Date();
    fourthDay.setTime(firstDay.getTime() + (3*864e5));
    fourthDay.setHours(0, 0, 0, 0);
    let fifthDay = new Date();
    fifthDay.setTime(firstDay.getTime() + (4*864e5));
    fifthDay.setHours(0, 0, 0, 0);

    const thisWeek = [firstDay, secondDay, thirdDay, fourthDay, fifthDay]
    for (let i = 0; i < my_data.length; i++) {
        let temp = [];
        temp = my_data[i];
        for (const j in thisWeek) {
            if((thisWeek[j].getFullYear() === temp[1].getFullYear())&&(thisWeek[j].getMonth() === temp[1].getMonth()) && (thisWeek[j].getDate() === temp[1].getDate())){
                week_chassis[j].push(temp);
            }
        }
    }

    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    table.appendChild(thead);
    table.appendChild(tbody);

    let row_1 = document.createElement('tr');
    let heading_1 = document.createElement('th');
    let heading_2 = document.createElement('th');
    let heading_3 = document.createElement('th');
    let heading_4 = document.createElement('th');

    heading_1.innerHTML = "Datum";
    heading_2.innerHTML = "Wagennr";
    heading_3.innerHTML = "Klantnaam";
    heading_4.innerHTML = "WagenType";
    row_1.appendChild(heading_1);
    row_1.appendChild(heading_2);
    row_1.appendChild(heading_3);
    row_1.appendChild(heading_4);
    thead.appendChild(row_1);


    // Adding the entire table to the body tag
    document.getElementById(my_table_id).appendChild(table);
    for (let i =0; i<week_chassis.length; i++){
        let temp_chassis = week_chassis[i];
        for (let j = 0; j < temp_chassis.length; j++){
            let new_row = document.createElement('tr');
            let row_date = document.createElement('td');
            let row_wagennr = document.createElement('td');
            let row_klantnaam = document.createElement('td');
            let row_wagentype = document.createElement('td');
            let temp = temp_chassis[j];
            row_date.innerHTML = temp[1].getDate() + "/" + (temp[1].getMonth()+1);
            row_wagennr.innerHTML = temp[0];
            row_klantnaam.innerHTML = temp[2];
            row_wagentype.innerHTML = temp[3];
            new_row.appendChild(row_date);
            new_row.appendChild(row_wagennr);
            new_row.appendChild(row_wagentype);
            new_row.appendChild(row_klantnaam);
            tbody.appendChild(new_row);
        }
    }
}

/*
 * Function to create a chart for the amount of chassis for the current week and the next week
 * Input: array that contains the data with the different dates and the year that is required to calculate
 * the year, month and starting date that you want a chart to be created for
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
function createWeekBarChart(my_data, next_week, my_graph_id, my_graph_title){
    const week_chassis_count = new Array(5).fill(0);
    const tooltip_data = [[], [], [], [], []];
    const curr = new Date; // get current date
    const first = curr.getDate() - curr.getDay() + 1;
    let firstDay = new Date(curr.setDate(first));
    firstDay.setHours(0, 0, 0, 0);

    switch (next_week){
        case 1:
            firstDay.setDate(firstDay.getDate() + 7);
            firstDay.setHours(0, 0, 0, 0);
            break;
        case 2:
            firstDay.setDate(firstDay.getDate() + 14);
            firstDay.setHours(0, 0, 0, 0);
            break;
    }

    const weekNumber = calculateWeekNumber(firstDay);
    my_graph_title = my_graph_title + " (week " + weekNumber + ")"

    let secondDay = new Date();
    secondDay.setTime(firstDay.getTime() + 864e5);
    secondDay.setHours(0, 0, 0, 0);
    let thirdDay = new Date();
    thirdDay.setTime(firstDay.getTime() + (2*864e5));
    thirdDay.setHours(0, 0, 0, 0);
    let fourthDay = new Date();
    fourthDay.setTime(firstDay.getTime() + (3*864e5));
    fourthDay.setHours(0, 0, 0, 0);
    let fifthDay = new Date();
    fifthDay.setTime(firstDay.getTime() + (4*864e5));
    fifthDay.setHours(0, 0, 0, 0);
    let sixthDay = new Date();
    sixthDay.setTime(firstDay.getTime() + (5*864e5));
    sixthDay.setHours(0, 0, 0, 0);
    let lastDay = new Date();
    lastDay.setTime(firstDay.getTime() + (6*864e5));
    lastDay.setHours(0, 0, 0, 0);

    const thisWeek = [firstDay, secondDay, thirdDay, fourthDay, fifthDay]
    const labels = [
        firstDay.getDate() + '/' + (firstDay.getMonth() + 1),
        secondDay.getDate() + '/' + (secondDay.getMonth() + 1),
        thirdDay.getDate() + '/' + (thirdDay.getMonth() + 1),
        fourthDay.getDate() + '/' + (fourthDay.getMonth() + 1),
        fifthDay.getDate() + '/' + (fifthDay.getMonth() + 1),
    ]
    for (let i = 0; i<my_data.length; i++){
        let temp = [];
        temp = my_data[i];
        for (const j in thisWeek){
            if ((temp[1].getFullYear() === thisWeek[j].getFullYear()) && (temp[1].getMonth() === thisWeek[j].getMonth()) && (temp[1].getDate() === thisWeek[j].getDate())){
                week_chassis_count[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_data[j].push(tooltip_temp);
            }
        }
    }
    const data = {
        labels: labels, datasets: [{
            label: 'Aantal chassis', backgroundColor: 'rgb(16, 57, 93)', data: week_chassis_count,font: {
                size: 17,
            }
        }]
    };
    const config = {
        type: 'bar', data: data, options: {
            scales: {
                y: {
                    ticks:{
                        precision: 0,
                        display: false
                    },
                    beginAtZero: true, display: true, title:{
                        display:false, text: "Aantal chassis"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                },
                x:{
                    display: true, title:{
                        display:true, text: "Datum",
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                tooltip:{
                    callbacks: {
                        beforeTitle: function (context){
                            return `Gepland op ${context[0].label}:`;
                        },
                        title: function(context){
                            return `Wagennr, Wagentype, Klantnaam`;
                        },
                        beforeBody: function(context){
                            return tooltip_data[context[0].dataIndex];
                        },
                    }
                },
                title:{
                    display: true, text: my_graph_title, font:{
                        size: 18
                    },
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                },

            },
        },
    }
    const myChart = new Chart(document.getElementById(my_graph_id), config);
    const modalChart = new Chart(document.getElementById(my_graph_id + '_modal'), config);
}


function createWeekWeldingChart(my_data, next_week, my_graph_id, my_graph_title){
    const week_stand_las_0 = new Array(5).fill(0);
    const week_stand_las_1 = new Array(5).fill(0);
    const week_stand_las_2 = new Array(5).fill(0);
    const week_stand_las_3 = new Array(5).fill(0);
    const week_stand_las_4 = new Array(5).fill(0);
    const tooltip_data_stand_0 = [[], [], [], [], []];
    const tooltip_data_stand_1 = [[], [], [], [], []];
    const tooltip_data_stand_2 = [[], [], [], [], []];
    const tooltip_data_stand_3 = [[], [], [], [], []];
    const tooltip_data_stand_4 = [[], [], [], [], []];
    const all_tooltip_data = [[], [], [], [], []];


    const curr = new Date; // get current date
    const first = curr.getDate() - curr.getDay() + 1;
    let firstDay = new Date(curr.setDate(first));
    firstDay.setHours(0, 0, 0, 0);

    if (next_week === 1){
        firstDay.setDate(firstDay.getDate() + 7);
        firstDay.setHours(0, 0, 0, 0);
    }
    else if (next_week === 2){
        firstDay.setDate(firstDay.getDate() + 14);
        firstDay.setHours(0, 0, 0, 0);
    }

    let secondDay = new Date();
    secondDay.setTime(firstDay.getTime() + 864e5);
    secondDay.setHours(0, 0, 0, 0);
    let thirdDay = new Date();
    thirdDay.setTime(firstDay.getTime() + (2*864e5));
    thirdDay.setHours(0, 0, 0, 0);
    let fourthDay = new Date();
    fourthDay.setTime(firstDay.getTime() + (3*864e5));
    fourthDay.setHours(0, 0, 0, 0);
    let fifthDay = new Date();
    fifthDay.setTime(firstDay.getTime() + (4*864e5));
    fifthDay.setHours(0, 0, 0, 0);

    const thisWeek = [firstDay, secondDay, thirdDay, fourthDay, fifthDay]
    const labels = [
        firstDay.getDate() + '/' + (firstDay.getMonth() + 1),
        secondDay.getDate() + '/' + (secondDay.getMonth() + 1),
        thirdDay.getDate() + '/' + (thirdDay.getMonth() + 1),
        fourthDay.getDate() + '/' + (fourthDay.getMonth() + 1),
        fifthDay.getDate() + '/' + (fifthDay.getMonth() + 1),
    ]

    for (const i in stand_las_0){
        for (const j in thisWeek){
            if ((stand_las_0[i][1].getFullYear() === thisWeek[j].getFullYear()) && (stand_las_0[i][1].getMonth() === thisWeek[j].getMonth()) && (stand_las_0[i][1].getDate() === thisWeek[j].getDate())){
                week_stand_las_0[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_data_stand_0[j].push(tooltip_temp);
            }
        }
    }

    for (const i in stand_las_1){
        for (const j in thisWeek){
            if ((stand_las_1[i][1].getFullYear() === thisWeek[j].getFullYear()) && (stand_las_1[i][1].getMonth() === thisWeek[j].getMonth()) && (stand_las_1[i][1].getDate() === thisWeek[j].getDate())){
                week_stand_las_1[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_data_stand_1[j].push(tooltip_temp);
            }
        }
    }

    for (const i in stand_las_2){
        for (const j in thisWeek){
            if ((stand_las_2[i][1].getFullYear() === thisWeek[j].getFullYear()) && (stand_las_2[i][1].getMonth() === thisWeek[j].getMonth()) && (stand_las_2[i][1].getDate() === thisWeek[j].getDate())){
                week_stand_las_2[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_data_stand_2[j].push(tooltip_temp);
            }
        }
    }

    for (const i in stand_las_3){
        for (const j in thisWeek){
            if ((stand_las_3[i][1].getFullYear() === thisWeek[j].getFullYear()) && (stand_las_3[i][1].getMonth() === thisWeek[j].getMonth()) && (stand_las_3[i][1].getDate() === thisWeek[j].getDate())){
                week_stand_las_3[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_data_stand_3[j].push(tooltip_temp);
            }
        }
    }

    for (const i in stand_las_4){
        for (const j in thisWeek){
            if ((stand_las_4[i][1].getFullYear() === thisWeek[j].getFullYear()) && (stand_las_4[i][1].getMonth() === thisWeek[j].getMonth()) && (stand_las_4[i][1].getDate() === thisWeek[j].getDate())){
                week_stand_las_4[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_data_stand_4[j].push(tooltip_temp);
            }
        }
    }
    all_tooltip_data[0].push(tooltip_data_stand_0);
    all_tooltip_data[1].push(tooltip_data_stand_1);
    all_tooltip_data[2].push(tooltip_data_stand_2);
    all_tooltip_data[3].push(tooltip_data_stand_3);
    all_tooltip_data[4].push(tooltip_data_stand_4);


    const weekNumber = calculateWeekNumber(firstDay);
    my_graph_title = my_graph_title + " (week " + weekNumber + ")"

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Nog te bepalen',
                data: week_stand_las_0,
                backgroundColor: 'rgb(150,196,237)',
                stack: 'Stack 0',
                pointStyle: 'circle',
            },
            {
                label: 'Handlas',
                data: week_stand_las_1,
                backgroundColor: 'rgb(51,141,220)',
                stack: 'Stack 1',
                pointStyle: 'circle',
            },
            {
                label: 'In robot',
                data: week_stand_las_2,
                backgroundColor: 'rgb(30,108,176)',
                stack: 'Stack 2',
                pointStyle: 'circle',
            },
            {
                label: 'In robot en programma af',
                data: week_stand_las_3,
                backgroundColor: 'rgb(16, 57, 93)',
                stack: 'Stack 3',
                pointStyle: 'circle',
            },
            {
                label: 'Geen gegevens',
                data: week_stand_las_4,
                backgroundColor: 'rgb(7,25,41)',
                stack: 'Stack 4',
                pointStyle: 'circle',
            },
        ]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                title: {
                    display: true, text: my_graph_title, font: {
                        size: 18,
                    },
                },
                legend: {
                    position: "top", labels: {
                        usePointStyle: true, font: {
                            size: 14,
                        },
                    },
                },
                tooltip:{
                    callbacks: {
                        beforeTitle: function (context){
                            return `Gepland op ${context[0].label} - ${context[0].dataset.label}`;
                        },
                        title: function(context){
                            return `Wagennr, Wagentype, Klantnaam`;
                        },
                        beforeBody: function(context){
                            return all_tooltip_data[context[0].datasetIndex][0][context[0].dataIndex]
                        },
                    }
                },
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    stacked: true, beginAtZero: true, display: true, categoryPercentage: 0.0, barPercentage: 0.0,
                    title:{
                        display:true, text: "Datum",
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    },

                },
                y: {
                    stacked: true, beginAtZero: true, display: true, ticks:{
                        precision: 0,
                        display: false
                    },
                    title:{
                        display:false, text: "Aantal chassis"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            }
        }
    };
    const myChart = new Chart(document.getElementById(my_graph_id), config);
    const modalChart = new Chart(document.getElementById(my_graph_id + '_modal'), config);

}


/*
   MODALS
 */

let modal_this_week = document.getElementById("modal_this_week");
let this_week_chart = document.getElementById("this_week_chart");
let close_this_week = document.getElementsByClassName("close this_week")[0];
this_week_chart.onclick = function() {
    modal_this_week.style.display = "block";
}
close_this_week.onclick = function() {
    modal_this_week.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal_this_week) {
        modal_this_week.style.display = "none";
    }
}

let modal_next_week = document.getElementById("modal_next_week");
let next_week_chart = document.getElementById("next_week_chart");
let close_next_week = document.getElementsByClassName("close next_week")[0];
next_week_chart.onclick = function() {
    modal_next_week.style.display = "block";
}
close_next_week.onclick = function() {
    modal_next_week.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal_next_week) {
        modal_next_week.style.display = "none";
    }
}

let modal_fortnight = document.getElementById("modal_fortnight");
let fortnight_chart = document.getElementById("fortnight_chart");
let close_fortnight = document.getElementsByClassName("close fortnight")[0];
fortnight_chart.onclick = function() {
    modal_fortnight.style.display = "block";
}
close_fortnight.onclick = function() {
    modal_fortnight.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal_fortnight) {
        modal_fortnight.style.display = "none";
    }
}

let modal_this_week_weld = document.getElementById("modal_this_week_weld");
let this_week_welding_chart = document.getElementById("this_week_welding_chart");
let this_week_weld = document.getElementsByClassName("close this_week_weld")[0];
this_week_welding_chart.onclick = function() {
    modal_this_week_weld.style.display = "block";
}
this_week_weld.onclick = function() {
    modal_this_week_weld.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal_this_week_weld) {
        modal_this_week_weld.style.display = "none";
    }
}

let modal_next_week_weld = document.getElementById("modal_next_week_weld");
let next_week_welding_chart = document.getElementById("next_week_welding_chart");
let next_week_weld = document.getElementsByClassName("close next_week_weld")[0];
next_week_welding_chart.onclick = function() {
    modal_next_week_weld.style.display = "block";
}
next_week_weld.onclick = function() {
    modal_next_week_weld.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal_next_week_weld) {
        modal_next_week_weld.style.display = "none";
    }
}

let modal_fortnight_weld = document.getElementById("modal_fortnight_weld");
let fortnight_welding_chart = document.getElementById("fortnight_welding_chart");
let fortnight_weld = document.getElementsByClassName("close fortnight_weld")[0];
fortnight_welding_chart.onclick = function() {
    modal_fortnight_weld.style.display = "block";
}
fortnight_weld.onclick = function() {
    modal_fortnight_weld.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal_fortnight_weld) {
        modal_fortnight_weld.style.display = "none";
    }
}

function showDashboard(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("dashboard-options");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}