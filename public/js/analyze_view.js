//Enable tooltip
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

//Enable Popover
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})

//Generate popovers
for(let i = 1; i < chassis_info.length; i++) {
    $('#chassis_' + i).popover({
        trigger: 'click',
        title: 'Chassis: ' + chassis_info[i][1],
        content: 'DLnr: ' + chassis_info[i][2] + '\n' +
            'Kaliber: ' + chassis_info[i][3] + ' ' + chassis_info[i][4] + '\n' +
            'NaamFase: ' + chassis_info[i][5] + '\n' +
            'NaamKlant: ' + chassis_info[i][6] + ' ' + chassis_info[i][7] + ' ' + chassis_info[i][8]  + '\n' +
            'NaamType: ' + chassis_info[i][9] + '\n' +
            'Natie: ' + chassis_info[i][10] + '\n' +
            'StandInProd: ' + chassis_info[i][11] + '\n' +
            'ReeksVan: ' + chassis_info[i][12] + '\n' +
            'ReeksTot: ' + chassis_info[i][13] + '\n'
    });
}

function createPieChartWelding(){
    //set the dimensions and margins of the graph
    var margin = {top: 30, right: 30, bottom: 70, left: 60},
        width = 460 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3.select("#my_dataviz")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

        // Parse the Data
        d3.csv("https://raw.githubusercontent.com/holtzy/data_to_viz/master/Example_dataset/7_OneCatOneNum_header.csv", function(data) {
            // X axis
            var x = d3.scaleBand()
                .range([ 0, width ])
                .domain(data.map(function(d) { return d.Country; }))
                .padding(0.2);
            svg.append("g")
                .attr("transform", "translate(0," + height + ")")
                .call(d3.axisBottom(x))
                .selectAll("text")
                .attr("transform", "translate(-10,0)rotate(-45)")
                .style("text-anchor", "end");

            // Add Y axis
            var y = d3.scaleLinear()
                .domain([0, 13000])
                .range([ height, 0]);
            svg.append("g")
                .call(d3.axisLeft(y));

            // Bars
            svg.selectAll("mybar")
                .data(data)
                .enter()
                .append("rect")
                .attr("x", function(d) { return x(d.Country); })
                .attr("y", function(d) { return y(d.Value); })
                .attr("width", x.bandwidth())
                .attr("height", function(d) { return height - y(d.Value); })
                .attr("fill", "#69b3a2")

        })
    }
