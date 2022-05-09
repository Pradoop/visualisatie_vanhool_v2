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

        <?php $title_array = preg_split('/\t/', $file_lines[0]); ?>
        <thead>
            <tr>
                <th id="th0" onclick="showSortIcons(0)"><?= $title_array[0] ?></th> <!-- Wagen !-->
                <th id="th1" onclick="showSortIcons(1)"><?= $title_array[2] ?></th> <!-- Aantal !-->
                <th id="th2" onclick="showSortIcons(2)"><?= $title_array[5] ?></th> <!-- NaamWagen !-->
                <th id="th3" onclick="showSortIcons(3)"><?= $title_array[7] ?></th> <!-- NaamKlant !-->
                <th id="th4" onclick="showSortIcons(4)"><?= $title_array[10] ?></th> <!-- ReeksVan !-->
                <th id="th5" onclick="showSortIcons(5)"><?= $title_array[12] ?></th> <!-- Galva !-->
                <th id="th6" onclick="showSortIcons(6)"><?= $title_array[14] ?></th> <!-- Status !-->
                <th id="th7" onclick="showSortIcons(7)"><?= $title_array[3] ?></th> <!-- dtmGepland !-->
                <th id="th8" onclick="showSortIcons(8)"><?= $title_array[17] ?></th> <!-- wdInMont !-->
                <th id="th9" onclick="showSortIcons(9)">Dagen tot gepland</th> <!-- huidige datum tov geplande datum !-->
            </tr>
        </thead>

        <?php
        $chassis_array = array();
        $index = 1;
        while($index < sizeof($file_lines) - 1) {
            $array = preg_split('/\t/', $file_lines[$index]);
            $line_array = array();
            array_push($line_array, $array[0]);
            array_push($line_array, $array[2]);
            array_push($line_array, $array[5]);
            array_push($line_array, $array[7]);
            array_push($line_array, $array[10]);
            array_push($line_array, $array[12]);
            array_push($line_array, $array[14]);
            array_push($line_array, $array[3]);
            array_push($line_array, $array[17]);

            //Convert to correct format
            $today = date("Y-m-d");
            $parts = str_split($array[3], 2);
            $planned_date = '20'.$parts[0].'-'.$parts[1].'-'.$parts[2];
            $diff = strtotime($planned_date) - strtotime($today);

            array_push($line_array, round($diff / 86400));

            array_push($chassis_array, $line_array);
            $index++;
        }
        ?>

        <script > let file_lines = <?php echo json_encode($chassis_array); ?>;</script>

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
