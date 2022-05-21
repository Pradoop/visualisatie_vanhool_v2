<div id="table_title">
    <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
</div>

<div id="table_content">
    <table id="chassis_table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th id="th0">Wagen</th>
            <th id="th1">Aantal</th>
            <th id="th2">NaamWagenTyp</th>
            <th id="th3">NaamKlant</th>
            <th id="th4">ReeksVan</th>
            <th id="th5">Galva</th>
            <th id="th6">Status</th>
            <th id="th7">dtmGepland</th>
            <th id="th8">wdInMont</th>
            <th id="th9">Dagen tot gepland</th>
        </tr>
        </thead>

        <?php
        $chassis_array = array();
        $index = 0;
        while($index < sizeof($file_lines)) {
            $array = preg_split('/!/', $file_lines[$index]);
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
