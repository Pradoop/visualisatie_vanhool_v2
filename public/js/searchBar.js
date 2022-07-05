$("#search_input").on("keyup", function() {

    let value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

    let rows = document.getElementById("chassis_table").rows;
    let rows_shown = 0;
    for(let i = 1; i < rows.length; i++) {
        if(rows[i].style.display !== "none") {
            rows_shown++;
        }
    }
    if(rows_shown === 0) {
        document.getElementById("count_div_text").innerHTML = "0 van " + (rows.length - 1) + " resultaten";
    }
    else {
        document.getElementById("count_div_text").innerHTML = "1 tot " + rows_shown + " van " + (rows.length - 1) + " resultaten";
    }
});