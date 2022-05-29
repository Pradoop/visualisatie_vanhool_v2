const welding_data = [], total_welding_data = [], chassis_phase = [];
const chassisnr_pln_date = [], chassis_pln_date = [], chassis_per_year = [];
const stand_las_0 = [], stand_las_1 = [], stand_las_2 = [], stand_las_3 = [];
const chassis_per_month = new Array(12).fill(0);
const chassis_per_week = new Array(4).fill(0);
const chassis_per_dag = new Array(7).fill(0);
const months = ['Jan', 'Feb', 'Ma', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec']

/*
 * Registration of the chartjs-plugin-datalabels plugin. Is required to make it work
 * Changing default options as well for the text in the bars
 */
Chart.register(ChartDataLabels);
Chart.defaults.set('plugins.datalabels', {
    color: 'white'
});

/*
 * Ajax request to retrieve the data for welding
 * This call also executes the createWeldingChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/calculateTotalWeldingData',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        for(const c in responseObject){
            welding_data.push(responseObject[c]);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createWeldingChart(welding_data);
    }
});

/*
 * Ajax request to retrieve all the data for welding
 * This call also executes the createWeldingChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/getWeldingData',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        let year = "";
        const tempYear = "";
        for(const c in responseObject){

            let temp = responseObject[c].dtm_gepland;

            //reformat date
            year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
            let month = temp.substring(2, 4);
            let day = temp.substring(4, 6);
            let date = new Date(year, month - 1, day);
            date.setHours(0, 0, 0, 0);
            responseObject[c].dtm_gepland = date;
            total_welding_data.push(responseObject[c])

        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createWeekWeldingChart(total_welding_data, 1, 'next_week_welding_chart', 'Aantal chassis per stand las - volgende week');
        createWeekWeldingChart(total_welding_data, 0, 'this_week_welding_chart', 'Aantal chassis per stand las - deze week');
    }
});

/*
 * Ajax request to retrieve the chassis per phase
 * This call also executes the createPhaseChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/calculateChassisPerPhase',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        for(const c in responseObject){
            chassis_phase.push(responseObject[c]);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createPhaseChart(chassis_phase);
    }
});

/*
 * Ajax request to retrieve all the dtmGepland
 * This call also executes the createPhaseChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/getPlannedTime',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        let year = "";
        const tempYear = "";
        for(const c in responseObject){

            //reformat date
            let temp = responseObject[c];
            year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
            let month = temp.substring(2, 4);
            let day = temp.substring(4, 6);
            let date = new Date(year, month - 1, day);
            date.setHours(0, 0, 0, 0);

            chassis_pln_date.push(date);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        let today = new Date();
        let currentYear = today.getFullYear();
        let currentMonth = today.getMonth() + 1;
        let currentDate = today.getDate() + 1;

        createWeekBarChart(chassis_pln_date, 0, 'this_week_chart', "Aantal geplande chassis: deze week");
        createWeekBarChart(chassis_pln_date, 1, 'next_week_chart', "Aantal geplande chassis: volgende week");
        createWeekBarChart(chassis_pln_date, 2, 'fortnight_chart', "Aantal geplande chassis in twee weken");
        createYearChart(chassis_pln_date);
        createMonthChart(currentYear, chassis_pln_date);
        createWeekChart(currentYear, currentMonth, chassis_pln_date);
        //createDateChart(currentYear, currentMonth, currentDate, chassis_pln_date);
    }
});

/*
 * Ajax request to retrieve all the dtmGepland
 * This call also executes the createPhaseChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/getPlannedChassisAndTime',
    method: "get",
    dataType: 'text',
    success: function(response) {
        const responseObject = JSON.parse(response);
        let year = "";
        const tempYear = "";
        for(let i = 0; i < responseObject.length; i++){
            if (i % 2 !== 0 ){
                const temp = responseObject[i];
                year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
                const month = temp.substring(2, 4);
                const day = temp.substring(4, 6);
                let date = new Date(year, month - 1, day);
                date.setHours(0, 0, 0, 0);
                chassisnr_pln_date.push(date);
            }
            else{
                chassisnr_pln_date.push(responseObject[i]);
            }
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        calculateChassisPlannedToday(chassisnr_pln_date);
        calculateAmountDelayed(chassisnr_pln_date);
        createTableChassisPlannedPerWeek(chassisnr_pln_date, 0, 'chassis-this-week-table', 'Chassis gepland deze week');
        createTableChassisPlannedPerWeek(chassisnr_pln_date, 1, 'chassis-next-week-table', 'Chassis gepland volgende week');
        createTableChassisPlannedPerWeek(chassisnr_pln_date, 2, 'chassis-two-weeks-table', 'Chassis gepland in twee weken');
    }
});

function calculateWeekNumber(my_date){
    //To calculate week number
    let oneJan = new Date(my_date.getFullYear(), 0, 1);
    let numberOfDays = Math.floor((my_date - oneJan) / (24 * 60 * 60 * 1000));
    return Math.ceil((my_date.getDay() + 1 + numberOfDays) / 7)
}

function createTableChassisPlannedPerWeek(my_data, next_week, my_table_id, my_title){
    const week_chassis = [[], [], [], [], [], [], []];
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
    my_title = my_title + " (week " + weekNumber + ")";
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
    let sixthDay = new Date();
    sixthDay.setTime(firstDay.getTime() + (5*864e5));
    sixthDay.setHours(0, 0, 0, 0);
    let lastDay = new Date();
    lastDay.setTime(firstDay.getTime() + (6*864e5));
    lastDay.setHours(0, 0, 0, 0);

    const thisWeek = [firstDay, secondDay, thirdDay, fourthDay, fifthDay, sixthDay, lastDay]
    const labels = [
        firstDay.getDate() + '/' + (firstDay.getMonth() + 1),
        secondDay.getDate() + '/' + (secondDay.getMonth() + 1),
        thirdDay.getDate() + '/' + (thirdDay.getMonth() + 1),
        fourthDay.getDate() + '/' + (fourthDay.getMonth() + 1),
        fifthDay.getDate() + '/' + (fifthDay.getMonth() + 1),
        sixthDay.getDate() + '/' + (sixthDay.getMonth() + 1),
        lastDay.getDate() + '/' + (lastDay.getMonth() + 1),
    ]

    for (let i = 1; i <= my_data.length; i += 2) {
        for (const j in thisWeek) {
            if ((thisWeek[j].getFullYear() === my_data[i].getFullYear()) && (thisWeek[j].getMonth() === my_data[i].getMonth()) && (thisWeek[j].getDate() === my_data[i].getDate())) {
                week_chassis[j].push(my_data[i - 1]);
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
    heading_1.innerHTML = "Datum";
    let heading_2 = document.createElement('th');
    heading_2.innerHTML = "Wagennr";
    row_1.appendChild(heading_1);
    row_1.appendChild(heading_2);
    thead.appendChild(row_1);


    // Adding the entire table to the body tag
    document.getElementById(my_table_id).appendChild(table);

    for (const i in week_chassis){
        let new_row = document.createElement('tr');
        let row_date = document.createElement('td');
        row_date.innerHTML = labels[i];
        row_date.style.cssText = "font-style:italic;border-right:2px#10395d;";
        new_row.appendChild(row_date);
        let next_row = document.createElement('tr');
        for (const j in week_chassis[i]){
            let new_row_data = document.createElement('td');
            new_row_data.innerHTML = week_chassis[i][j] + ";";
            next_row.appendChild(new_row_data);
        }
        tbody.appendChild(new_row);
        new_row.appendChild(next_row);
        next_row.style.cssText = "margin-left:10%;"
    }
}

/*
 * Function to calculate the amount of chassis that are planned today
 * Input: array that contains the data with the different dates
 * Output: Amount of chassis that are planned for that day
 */
function calculateChassisPlannedToday(my_data){
    let today = new Date();
    let count = 0;
    for (let i = 1; i <= my_data.length; i += 2){
        if ((today.getFullYear() === my_data[i].getFullYear()) && (today.getMonth() === my_data[i].getMonth()) && (today.getDate() === my_data[i].getDate())){
            count++;
        }
    }
    document.getElementById('chassis-planned-today').innerHTML = count+ " chassis";
}

function calculateAmountDelayed(my_data){
    let today = new Date();
    let count = 0;
    for (let i = 1; i <= my_data.length; i += 2){
        if (today.getTime() > my_data[i].getTime()){
            count++;
        }
    }
    document.getElementById('chassis-delayed').innerHTML = count+ " chassis";
}


/*
 * Function to create a chart for the amount of chassis for the current week and the next week
 * Input: array that contains the data with the different dates and the year that is required to calculate
 * the year, month and starting date that you want a chart to be created for
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
function createWeekBarChart(my_data, next_week, my_graph_id, my_graph_title){
    const week_chassis = new Array(7).fill(0);
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

    const thisWeek = [firstDay, secondDay, thirdDay, fourthDay, fifthDay, sixthDay, lastDay]
    const labels = [
        firstDay.getDate() + '/' + (firstDay.getMonth() + 1),
        secondDay.getDate() + '/' + (secondDay.getMonth() + 1),
        thirdDay.getDate() + '/' + (thirdDay.getMonth() + 1),
        fourthDay.getDate() + '/' + (fourthDay.getMonth() + 1),
        fifthDay.getDate() + '/' + (fifthDay.getMonth() + 1),
        sixthDay.getDate() + '/' + (sixthDay.getMonth() + 1),
        lastDay.getDate() + '/' + (lastDay.getMonth() + 1),
    ]

    for (const i in my_data){
        for (const j in thisWeek){
            if ((my_data[i].getFullYear() === thisWeek[j].getFullYear()) && (my_data[i].getMonth() === thisWeek[j].getMonth()) && (my_data[i].getDate() === thisWeek[j].getDate())){
                week_chassis[j]++;
            }
        }
    }
    const data = {
        labels: labels, datasets: [{
            label: 'Aantal chassis', backgroundColor: 'rgb(16, 57, 93)', data: week_chassis,
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
                        display:true, text: "Datum"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: my_graph_title
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                },
            }
        },
    }
    const myChart = new Chart(document.getElementById(my_graph_id), config);
}

/*
 * Function to create a chart for the amount of chassis per day
 * in a given year, month and starting date for the next seven days
 * Input: array that contains the data with the different dates and the year that is required to calculate
 * the year, month and starting date that you want a chart to be created for
 * Output: Vertical bart chart with the amount of chassis that are planned per year

function createDateChart(my_year, my_month, my_date, my_data){
    my_month--;
    let day_diff;
    let day1, day2, day3, day4, day5, day6, day7;
    for (const i in my_data){
        if(my_year === my_data[i].getFullYear() && (my_month - my_data[i].getMonth() === 0)){
            day_diff = my_data[i].getDate() - my_date;
            switch (day_diff){
                case 0:
                    chassis_per_dag[0]++;
                break;
                case 1:
                    chassis_per_dag[1]++;
                    break;
                case 2:
                    chassis_per_dag[2]++;
                    break;
                case 3:
                    chassis_per_dag[3]++;
                    break;
                case 4:
                    chassis_per_dag[4]++;
                    break;
                case 5:
                    chassis_per_dag[5]++;
                    break;
                case 6:
                    chassis_per_dag[6]++;
                    break;

            }
        }
    }
    my_month++;
    day1 = (my_date).toString() + "/" + my_month.toString();
    day2 = (my_date + 1).toString() + "/" + my_month.toString();
    day3 = (my_date + 2).toString() + "/" + my_month.toString();
    day4 = (my_date + 3).toString() + "/" + my_month.toString();
    day5 = (my_date + 4).toString() + "/" + my_month.toString() ;
    day6 = (my_date + 5).toString() + "/" + my_month.toString();
    day7 = (my_date + 6).toString() + "/" + my_month.toString();
    const labels = [day1, day2, day3, day4, day5, day6, day7];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: chassis_per_dag,
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
                        display:true, text: "Aantal chassis"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                },
                x:{
                    display: true, title:{
                        display:true, text: "Datum"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: 'Aantal geplande chassis per week voor de week van: ' + day1 + ' tot: ' + day7
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('day_chart'), config);
}
*/

/*
 * Function to create a chart for the amount of chassis per week in a given month and year
 * Input: array that contains the data with the different dates and the year that is required to calculate
 * the year and the month that you want a chart to be created for
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
function createWeekChart(my_year, my_month, my_data){
    my_month--;
    let week1, week2, week3, week4;
    for (const i in my_data){
        if(my_year === my_data[i].getFullYear() && (my_month - my_data[i].getMonth() === 0)){
            let my_date = my_data[i].getDate();
            if ( 1 <= my_date && my_date <= 7){
                chassis_per_week[0]++;
            }
            if ( 8 <= my_date && my_date <= 14){
                chassis_per_week[1]++;
            }
            if ( 15 <= my_date && my_date <= 21){
                chassis_per_week[2]++;
            }
            if ( 22 <= my_date && my_date <= 31){
                chassis_per_week[3]++;
            }
        }
    }
    my_month++;
    week1 = "1/" + my_month.toString() + " - " + "7/" + my_month.toString();
    week2 = "8/" + my_month.toString() + " - " + "14/" + my_month.toString();
    week3 = "15/" + my_month.toString() + " - " + "21/" + my_month.toString();
    week4 = "22/" + my_month.toString() + " - " + "31/" + my_month.toString();
    const labels = [week1, week2, week3, week4];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16,57,93)',
            data: chassis_per_week,
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
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
                        display:true, text: "Week"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: 'Aantal geplande chassis per week in de maand: ' + months[my_month - 1] + " " + my_year.toString()
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('week_chart'), config);
}


/*
 * Function to create a chart for the amount of chassis per month in a given year
 * Input: array that contains the data with the different dates and the year that is required to calculate
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
function createMonthChart(my_year, my_data){
    for (const i in my_data){
        if(my_year === my_data[i].getFullYear()){
            chassis_per_month[my_data[i].getMonth()]++;
        }
    }
    const data = {
        labels: months,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: chassis_per_month,
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
                        display:true, text: "Maand"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: 'Aantal geplande chassis per maand in het jaar: ' + my_year.toString()
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    },

                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('month_chart'), config);
}

/*
 * Function to create a chart based on the dates that are planned
 * Input: array that contains the data with the different dates
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
function createYearChart(my_data){
    for (const i in my_data){
        let yearDiff = my_data[i].getFullYear() - new Date().getFullYear();
        if (yearDiff >= chassis_per_year.length){
            chassis_per_year[yearDiff] = 0;
        }
        chassis_per_year[yearDiff]++;
    }
    const labels = [];
    for (const i in chassis_per_year){
        labels[i] = (new Date().getFullYear() + +i).toString();
    }
    const data = {
        labels: labels,
        datasets: [{
            label: 'Aantal ' +
                'chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: chassis_per_year,
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
                        display:true, text: "Jaar"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: 'Aantal geplande chassis per jaar'
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                }
            }
        },
    };
    const myChart = new Chart(document.getElementById('year_chart'), config);
}

function createWeekWeldingChart(my_data, next_week, my_graph_id, my_graph_title){
    for (const i in my_data){
        switch (my_data[i].stand_las){
            case "L0":
                stand_las_0.push(my_data[i]);
                break;
            case "L1":
                stand_las_1.push(my_data[i]);
                break;
            case "L2":
                stand_las_2.push(my_data[i]);
                break;
            case "L3":
                stand_las_3.push(my_data[i]);
                break;
        }
    }
    const week_stand_las_0 = new Array(7).fill(0);
    const week_stand_las_1 = new Array(7).fill(0);
    const week_stand_las_2 = new Array(7).fill(0);
    const week_stand_las_3 = new Array(7).fill(0);

    const curr = new Date; // get current date
    const first = curr.getDate() - curr.getDay() + 1;
    let firstDay = new Date(curr.setDate(first));
    firstDay.setHours(0, 0, 0, 0);

    if (next_week === 1){
        firstDay.setDate(firstDay.getDate() + 7);
        firstDay.setHours(0, 0, 0, 0);
    }

    let secondDay = new Date();
    secondDay.setDate(firstDay.getDate() + 1);
    secondDay.setHours(0, 0, 0, 0);
    let thirdDay = new Date();
    thirdDay.setDate(firstDay.getDate() + 2);
    thirdDay.setHours(0, 0, 0, 0);
    let fourthDay = new Date();
    fourthDay.setDate(firstDay.getDate() + 3);
    fourthDay.setHours(0, 0, 0, 0);
    let fifthDay = new Date();
    fifthDay.setDate(firstDay.getDate() + 4);
    fifthDay.setHours(0, 0, 0, 0);
    let sixthDay = new Date();
    sixthDay.setDate(firstDay.getDate() + 5);
    sixthDay.setHours(0, 0, 0, 0);
    let lastDay = new Date();
    lastDay.setDate(firstDay.getDate() + 6);
    lastDay.setHours(0, 0, 0, 0);

    const thisWeek = [firstDay, secondDay, thirdDay, fourthDay, fifthDay, sixthDay, lastDay]
    const labels = [
        firstDay.getDate() + '/' + (firstDay.getMonth() + 1),
        secondDay.getDate() + '/' + (secondDay.getMonth() + 1),
        thirdDay.getDate() + '/' + (thirdDay.getMonth() + 1),
        fourthDay.getDate() + '/' + (fourthDay.getMonth() + 1),
        fifthDay.getDate() + '/' + (fifthDay.getMonth() + 1),
        sixthDay.getDate() + '/' + (sixthDay.getMonth() + 1),
        lastDay.getDate() + '/' + (lastDay.getMonth() + 1),
    ]

    for (const i in stand_las_0){
        for (const j in thisWeek){
            if ((stand_las_0[i].dtm_gepland.getFullYear() === thisWeek[j].getFullYear()) && (stand_las_0[i].dtm_gepland.getMonth() === thisWeek[j].getMonth()) && (stand_las_0[i].dtm_gepland.getDate() === thisWeek[j].getDate())){
                week_stand_las_0[j]++;
            }
        }
    }

    for (const i in stand_las_1){
        for (const j in thisWeek){
            if ((stand_las_1[i].dtm_gepland.getFullYear() === thisWeek[j].getFullYear()) && (stand_las_1[i].dtm_gepland.getMonth() === thisWeek[j].getMonth()) && (stand_las_1[i].dtm_gepland.getDate() === thisWeek[j].getDate())){
                week_stand_las_1[j]++;
            }
        }
    }

    for (const i in stand_las_2){
        for (const j in thisWeek){
            if ((stand_las_2[i].dtm_gepland.getFullYear() === thisWeek[j].getFullYear()) && (stand_las_2[i].dtm_gepland.getMonth() === thisWeek[j].getMonth()) && (stand_las_2[i].dtm_gepland.getDate() === thisWeek[j].getDate())){
                week_stand_las_2[j]++;
            }
        }
    }

    for (const i in stand_las_3){
        for (const j in thisWeek){
            if ((stand_las_3[i].dtm_gepland.getFullYear() === thisWeek[j].getFullYear()) && (stand_las_3[i].dtm_gepland.getMonth() === thisWeek[j].getMonth()) && (stand_las_3[i].dtm_gepland.getDate() === thisWeek[j].getDate())){
                week_stand_las_3[j]++;
            }
        }
    }
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Nog te bepalen',
                data: week_stand_las_0,
                backgroundColor: 'rgb(16, 57, 93)',
                stack: 'Stack 0',
            },
            {
                label: 'Handlas',
                data: week_stand_las_1,
                backgroundColor: 'rgb(90,16,93)',
                stack: 'Stack 1',
            },
            {
                label: 'In robot',
                data: week_stand_las_2,
                backgroundColor: 'rgb(93,52,16)',
                stack: 'Stack 2',
            },
            {
                label: 'In robot en programma af',
                data: week_stand_las_3,
                backgroundColor: 'rgb(19,93,16)',
                stack: 'Stack 3',
            },
        ]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: my_graph_title
                },
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    stacked: true, beginAtZero: true, display: true, categoryPercentage: 0.0, barPercentage: 0.0,
                    title:{
                        display:true, text: "Datum"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
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

}

/*
 * Function to create a chart based on the welding data
 * Input: array that contains the data for welding
 * Output: Vertical bart chart with the amount of chassis per stand las
 */
function createWeldingChart(my_data){
    const labels = ['TBD', 'Hand', 'Robot', 'Robot+prgm af'];
    let arrayOfObjects = labels.map(function (d, i) {
        return {
            label: d,
            data: my_data[i] || 0
        };
    });
    let sortedArrayOfObjects = arrayOfObjects.sort(function (a, b) {
        return b.data > a.data;
    });
    let sortedLabelArray = [];
    let sortedDataArray = [];

    sortedArrayOfObjects.forEach(function(d){
        sortedLabelArray.push(d.label);
        sortedDataArray.push(d.data);
    });

    const data = {
        labels: sortedLabelArray, datasets: [{
            label: 'Aantal chassis', backgroundColor: 'rgb(16, 57, 93)', data: sortedDataArray,
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
                        display:true, text: "Aantal chassis"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                },
                x:{
                    display: true, title:{
                        display:true, text: "Stand las"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: 'Aantal chassis per per stand las'
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('stand_las_chart'), config);
}

/*
 * Function to create a chart based on the phase data
 * Input: array that contains the chassis per phase
 * Output: Vertical bart chart with the amount of chassis per phase
 */
function createPhaseChart(my_data){
    const labels = [
        'Verkocht', 'Start studie', 'Einde studie', 'Klaar voor werk', 'Start serie',
        'Prognose prefab', 'Prognose basiss', 'Klaar vo montage', 'Start kaliber',
        'Einde kaliber', 'Start lasrobot', 'Start aflassen', 'Morgen af', 'Vandaag af',
    ];
    let arrayOfObjects = labels.map(function (d, i) {
        return {
            label: d,
            data: my_data[i] || 0
        };
    });
    let sortedArrayOfObjects = arrayOfObjects.sort(function (a, b) {
        return b.data > a.data;
    });
    let sortedLabelArray = [];
    let sortedDataArray = [];

    sortedArrayOfObjects.forEach(function(d){
        sortedLabelArray.push(d.label);
        sortedDataArray.push(d.data);
    });
    const data = {
        labels: sortedLabelArray, datasets: [{
            label: 'Aantal chassis', backgroundColor: 'rgb(16, 57, 93)', data: sortedDataArray,
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
                        display:true, text: "Aantal chassis"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                },
                x:{
                    display: true, title:{
                        display:true, text: "Status"
                    },
                    grid: {
                        display: false,
                        drawBorder: false,
                    }
                }
            },
            plugins:{
                title:{
                    display: true, text: 'Aantal chassis per status'
                },
                legend:{
                    display: false, position: "right", align: "center", labels:{
                        boxWidth: 10, boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('status_chart'), config);
}




