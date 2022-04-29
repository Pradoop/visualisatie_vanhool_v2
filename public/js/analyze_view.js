const welding_data = [];
const chassis_phase = [];
const chassis_pln_date = [];
const chassis_per_year = [];
const chassis_per_month = new Array(12).fill(0);
const chassis_per_week = new Array(4).fill(0);
const chassis_per_dag = new Array(7).fill(0);
const months = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December']

/*
 * Ajax request to retrieve the data for welding
 * This call also executes the createWeldingChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/calculateWeldingData',
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
            const temp = responseObject[c];
            year = parseInt(tempYear.concat("20", temp.substring(0, 2)));
            const month = temp.substring(2, 4);
            const day = temp.substring(4, 6);
            const date = new Date(year, month - 1, day);
            chassis_pln_date.push(date);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createYearChart(chassis_pln_date);
        createMonthChart(2022, chassis_pln_date);
        createWeekChart(2022, 6, chassis_pln_date);
        createDateChart(2022, 6, 1, chassis_pln_date);
    }
});


/*
 * Function to create a chart for the amount of chassis per day
 * in a given year, month and starting date for the next seven days
 * Input: array that contains the data with the different dates and the year that is required to calculate
 * the year, month and starting date that you want a chart to be created for
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
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
    day1 = (my_date).toString() + "/" + my_month.toString() + "/" + my_year.toString();
    day2 = (my_date + 1).toString() + "/" + my_month.toString() + "/" + my_year.toString();
    day3 = (my_date + 2).toString() + "/" + my_month.toString() + "/" + my_year.toString();
    day4 = (my_date + 3).toString() + "/" + my_month.toString() + "/" + my_year.toString();
    day5 = (my_date + 4).toString() + "/" + my_month.toString() + "/" + my_year.toString();
    day6 = (my_date + 5).toString() + "/" + my_month.toString() + "/" + my_year.toString();
    day7 = (my_date + 6).toString() + "/" + my_month.toString() + "/" + my_year.toString();
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
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    ticks:{
                        precision: 0
                    },
                    beginAtZero: true,
                    display: true,
                    title:{
                        display:true,
                        text: "Aantal geplande chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Datum"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal geplande chassis per week voor de week van: ' + day1 + ' tot: ' + day7
                },
                legend:{
                    display: true,
                    position: "right",
                    align: "center",
                    labels:{
                        boxWidth: 10,
                        boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('day_chart'), config);
}

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
    week1 = "1/" + my_month.toString() + "/" + my_year.toString() +
        " tot " + "7/" + my_month.toString() + "/" + my_year.toString();
    week2 = "8/" + my_month.toString() + "/" + my_year.toString() +
        " tot " + "14/" + my_month.toString() + "/" + my_year.toString();
    week3 = "15/" + my_month.toString() + "/" + my_year.toString() +
        " tot " + "21/" + my_month.toString() + "/" + my_year.toString();
    week4 = "22/" + my_month.toString() + "/" + my_year.toString() +
        " tot " + "31/" + my_month.toString() + "/" + my_year.toString();
    const labels = [week1, week2, week3, week4];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16, 57, 93)',
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
                        precision: 0
                    },
                    beginAtZero: true,
                    display: true,
                    title:{
                        display:true,
                        text: "Aantal geplande chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Week"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal geplande chassis per week in de maand: ' + months[my_month - 1] + " " + my_year.toString()
                },
                legend:{
                    display: true,
                    position: "right",
                    align: "center",
                    labels:{
                        boxWidth: 10,
                        boxHeight: 10,
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
            label: 'Aantal geplande chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: chassis_per_month,
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: true,
                    title:{
                        display:true,
                        text: "Aantal geplande chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Maand"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal geplande chassis per maand in het jaar: ' + my_year.toString()
                },
                legend:{
                    display: true,
                    position: "right",
                    align: "center",
                    labels:{
                        boxWidth: 10,
                        boxHeight: 10,
                    }
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
            label: 'Aantal geplande chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: chassis_per_year,
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: true,
                    title:{
                        display:true,
                        text: "Aantal geplande chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Jaar"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal geplande chassis per jaar'
                },
                legend:{
                    display: true,
                    position: "right",
                    align: "center",
                    labels:{
                        boxWidth: 10,
                        boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('year_chart'), config);
}

/*
 * Function to create a chart based on the welding data
 * Input: array that contains the data for welding
 * Output: Vertical bart chart with the amount of chassis per stand las
 */
function createWeldingChart(my_data){
    const labels = [
        'TBD',
        'Hand',
        'Robot',
        'Robot+prgm af',
    ];
    arrayOfObjects = labels.map(function (d, i) {
        return{
            label: d,
            data: my_data[i] || 0
        };
    });
    sortedArrayOfObjects = arrayOfObjects.sort(function (a, b){
        return b.data > a.data;
    });
    sortedLabelArray = [];
    sortedDataArray = [];

    sortedArrayOfObjects.forEach(function(d){
        sortedLabelArray.push(d.label);
        sortedDataArray.push(d.data)
    });

    const data = {
        labels: sortedLabelArray,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: sortedDataArray,
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: true,
                    title:{
                        display:true,
                        text: "Aantal chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Jaar"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal chassis per jaar'
                },
                legend:{
                    display: true,
                    position: "right",
                    align: "center",
                    labels:{
                        boxWidth: 10,
                        boxHeight: 10,
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
        'Verkocht',
        'Start studie',
        'Einde studie',
        'Klaar voor werk',
        'Start serie',
        'Prognose prefab',
        'Prognose basiss',
        'Klaar vo montage',
        'Start kaliber',
        'Einde kaliber',
        'Start lasrobot',
        'Start aflassen',
        'Morgen af',
        'Vandaag af',
    ];
    arrayOfObjects = labels.map(function (d, i) {
        return{
            label: d,
            data: my_data[i] || 0
        };
    });
    sortedArrayOfObjects = arrayOfObjects.sort(function (a, b){
        return b.data > a.data;
    });
    sortedLabelArray = [];
    sortedDataArray = [];

    sortedArrayOfObjects.forEach(function(d){
        sortedLabelArray.push(d.label);
        sortedDataArray.push(d.data)
    });
    const data = {
        labels: sortedLabelArray,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: sortedDataArray,
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: true,
                    title:{
                        display:true,
                        text: "Aantal chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Status"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal chassis per status'
                },
                legend:{
                    display: true,
                    position: "right",
                    align: "center",
                    labels:{
                        boxWidth: 10,
                        boxHeight: 10,
                    }
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('status_chart'), config);
}




