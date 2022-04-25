//document.addEventListener("DOMContentLoaded", createPieChartWelding());

var data = [3, 10, 5, 26]

function createPieChartWelding(){
    console.log(data)
    const div = d3.create("div")
        .style("font", "10px sans-serif")
        .style("text-align", "right")
        .style("color", "white");

    div.selectAll("div")
        .data(data)
        .join("div")
        .style("background", "steelblue")
        .style("padding", "3px")
        .style("margin", "1px")
        .style("width", d => `${d * 10}px`)
        .text(d => d);

    return div.node();
    }

$.ajax({
    url: BASE_URL + '/Home/calculateWeldingData',
    method: "post",
    dataType: 'text',
    success: function(response) {
        console.log("SUCCESS")
        console.log(response)
    },
    error: function (xhr, status, error) {
        console.log("ERROR")
        console.log(xhr.responseText);
        console.log(error.responseText);
    }
});
