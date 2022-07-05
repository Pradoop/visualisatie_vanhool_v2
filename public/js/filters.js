let table, rows, i, x;
table = document.getElementById("chassis_table");
rows = table.rows;

for(i = 0; i < rows.length; i++) {
    x = rows[i].getElementsByTagName("TD")[1];
    if(x === 437823) {
        console.log("found");
        rows[i].style.display = "none";
    }
}


