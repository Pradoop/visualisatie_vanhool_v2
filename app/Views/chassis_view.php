<div id="table_title">
    <div id="afdelingNaam">
        <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
</div>

<div id="table_content">
    <table id="chassis_table" class="table table-striped table-hover">
        <?php $title_array = preg_split('/\t/', $chassis_info[0]); ?>
        <thead>
            <tr>
                <th id="th0" onclick="sorterCheck(0)"><?= $title_array[0] ?></th>
                <th id="th1" onclick="sorterCheck(1)"><?= $title_array[2] ?></th>
                <th id="th2" onclick="sorterCheck(2)"><?= $title_array[3] ?></th>
                <th id="th3" onclick="sorterCheck(3)"><?= $title_array[5] ?></th>
                <th id="th4" onclick="sorterCheck(4)"><?= $title_array[7] ?></th>
                <th id="th5" onclick="sorterCheck(5)"><?= $title_array[9] ?></th>
                <th id="th6" onclick="sorterCheck(6)"><?= $title_array[10] ?></th>
                <th id="th7" onclick="sorterCheck(7)"><?= $title_array[14] ?></th>
                <th id="th8" onclick="sorterCheck(8)"><?= $title_array[16] ?></th>
                <th id="th9" onclick="sorterCheck(9)"><?= $title_array[17] ?></th>
            </tr>
        </thead>

        <?php
        $chassis_array = array();
        $index = 1;
        while($index < sizeof($chassis_info) - 1) {
            $array = preg_split('/\t/', $chassis_info[$index]);
            unset($array[1],$array[4],$array[6],$array[8],$array[11],$array[12],$array[13],$array[15],$array[18],$array[19]);
            array_push($chassis_array, $array);
            $index++;
        }
        ?>

        <tbody id="myTable">
            <?php
            foreach ($chassis_array as $row) {
                echo '<tr>';
                foreach ($row as $item) {
                    echo "<td>{$item}</td>";
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
