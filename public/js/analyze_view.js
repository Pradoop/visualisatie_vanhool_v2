const welding_data = [];
const chassis_phase = [];
const chassis_pln_date = [];
const chassis_per_year = [];
const chassis_per_month = new Array(12).fill(0);;

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
        createMonthChart(2022);
    }
});

function createMonthChart(my_year){
    for (const i in chassis_pln_date){
        if(my_year === chassis_pln_date[i].getFullYear()){
            chassis_per_month[chassis_pln_date[i].getMonth()]++;
        }
    }
    const labels = [
        'Januari',
        'Februari',
        'Maart',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Augustus',
        'September',
        'Oktober',
        'November',
        'December'
    ];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Aantal chassis',
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
                        text: "Aantal chassis"
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
                    text: 'Aantal chassis per maand'
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
 * Function to create a chart based on the dates that are plannedd
 * Input: array that contains the data with the different dates
 * Output: Vertical bart chart with the amount of chassis that are planned per year
 */
function createYearChart(my_array){
    for (const i in my_array){
        let yearDiff = my_array[i].getFullYear() - new Date().getFullYear();
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
            label: 'Aantal chassis',
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
                        text: "Aantal chassis"
                    }
                },
                x:{
                    display: true,
                    title:{
                        display:true,
                        text: "Stand las"
                    }
                }
            },
            plugins:{
                title:{
                    display: true,
                    text: 'Aantal chassis per stand las'
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




