const historical_rendement_data = [];

$.ajax({
    url: BASE_URL + '/AnalyzeController/getHistoricalRendementData',
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
                    year = parseInt(tempYear.concat("20", temp.substring(4, 6)));
                    const month = temp.substring(2, 4);
                    const day = temp.substring(0, 2);
                    let date = new Date(year, month - 1, day);
                    date.setHours(0, 0, 0, 0);
                    currentObject[j] = date;
                }
            }
            historical_rendement_data.push(currentObject);
        }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createPastRendementChart(historical_rendement_data, 0, 'this_week_rendement_chart', "Aantal uit montage chassis: deze week");
        createPastRendementChart(historical_rendement_data, 1, 'last_week_rendement_chart', "Aantal uit montage chassis: vorige week");
        createPastRendementChart(historical_rendement_data, 2, 'two_weeks_ago_rendement_chart', "Aantal uit montage chassis: twee weken geleden");
        createPastRendementChart(historical_rendement_data, 3, 'three_weeks_ago_rendement_chart', "Aantal uit montage chassis: drie weken geleden");
        createCompletedLineChart(historical_rendement_data, 'completed_chart', "Aantal uit montage chassis: laatste 20 werkdagen")
    }
});

function calculateWeekNumber(my_date){
    //To calculate week number
    let oneJan = new Date(my_date.getFullYear(), 0, 1);
    let numberOfDays = Math.floor((my_date - oneJan) / (24 * 60 * 60 * 1000));
    return Math.ceil((my_date.getDay() + 1 + numberOfDays) / 7)
}

function createPastRendementChart(my_data, previous_week, my_graph_id, my_graph_title){
    const week_chassis_count = new Array(5).fill(0);
    const tooltip_data = [[], [], [], [], []];
    const curr = new Date; // get current date
    const first = curr.getDate() - curr.getDay() + 1;
    let firstDay = new Date(curr.setDate(first));
    firstDay.setHours(0, 0, 0, 0);

    switch (previous_week){
        case 1:
            firstDay.setDate(firstDay.getDate() - 7);
            firstDay.setHours(0, 0, 0, 0);
            break;
        case 2:
            firstDay.setDate(firstDay.getDate() - 14);
            firstDay.setHours(0, 0, 0, 0);
            break;
        case 3:
            firstDay.setDate(firstDay.getDate() - 21);
            firstDay.setHours(0, 0, 0, 0);
            break;
        case 4:
            firstDay.setDate(firstDay.getDate() - 28);
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
    for (let i = 1; i<my_data.length; i++){
        let temp = [];
        temp = my_data[i];
        for (const j in thisWeek){
            if ((temp[1].getFullYear() === thisWeek[j].getFullYear()) && (temp[1].getMonth() === thisWeek[j].getMonth()) && (temp[1].getDate() === thisWeek[j].getDate())){
                week_chassis_count[j]++;
                let tooltip_temp = [];
                tooltip_temp.push(my_data[i][0]);
                tooltip_temp.push(my_data[i][2]);
                tooltip_temp.push(my_data[i][3]);
                tooltip_temp.push(my_data[i][5]);
                tooltip_temp.push(my_data[i][4]);
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
                            return `Afgewerkt op ${context[0].label}:`;
                        },
                        title: function(context){
                            return `Wagennr, Uren gewerkt, Uren gepland, Wagentype, Klantnaam`;
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
    //const modalChart = new Chart(document.getElementById(my_graph_id + '_modal'), config);
}

function createCompletedLineChart(my_data, my_graph_id, my_graph_title){

}

