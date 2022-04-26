//document.addEventListener("DOMContentLoaded", createPieChartWelding());

var input_data = [];

$.ajax({
    url: BASE_URL + '/Home/calculateWeldingData',
    method: "get",
    dataType: 'text',
    success: function(response) {
        console.log("SUCCESS");
        console.log(response);

        const responseObject = JSON.parse(response);

        for(const c in responseObject){
            input_data.push(responseObject[c]);
            console.log(responseObject[c])
            }
    }
    ,
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    },
    complete: function(data){
        createWeldingChart(input_data);
    }
});


function createWeldingChart(my_data){
    const labels = [
        'Te bepalen',
        'Handmatig',
        'Robot',
        'Robot + programma af',

    ];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Stand Lassen',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: my_data,
        }]
    };
    console.log(data)
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    }
    const myChart = new Chart(document.getElementById('my_chart'), config);
}





