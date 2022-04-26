var input_data = [];

/*
 * Ajax request to retrieve the data for welding
 * This call also executes the createWeldingChart() function based on the data that is retrieved
 */
$.ajax({
    url: BASE_URL + '/Home/calculateWeldingData',
    method: "get",
    dataType: 'text',
    success: function(response) {
        console.log("SUCCESS");
        const responseObject = JSON.parse(response);
        for(const c in responseObject){
            input_data.push(responseObject[c]);
            }
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createWeldingChart(input_data);
    }
});

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
    const data = {
        labels: labels,
        datasets: [{
            label: 'Aantal chassis',
            backgroundColor: 'rgb(16, 57, 93)',
            data: my_data,
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
    const myChart = new Chart(document.getElementById('my_chart'), config);
}





