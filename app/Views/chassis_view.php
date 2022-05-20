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
        <thead>
        <tr>
            <th id="th0" onclick="showSortIcons(0)">Wagen</th> <!-- Wagen !-->
            <th id="th1" onclick="showSortIcons(1)">Aantal</th> <!-- Aantal !-->
            <th id="th2" onclick="showSortIcons(2)">NaamWagenTyp</th> <!-- NaamWagen !-->
            <th id="th3" onclick="showSortIcons(3)">NaamKlant</th> <!-- NaamKlant !-->
            <th id="th4" onclick="showSortIcons(4)">ReeksVan</th> <!-- ReeksVan !-->
            <th id="th5" onclick="showSortIcons(5)">Galva</th> <!-- Galva !-->
            <th id="th6" onclick="showSortIcons(6)">Status</th> <!-- Status !-->
            <th id="th7" onclick="showSortIcons(7)">dtmGepland</th> <!-- dtmGepland !-->
            <th id="th8" onclick="showSortIcons(8)">wdInMont</th> <!-- wdInMont !-->
            <th id="th9" onclick="showSortIcons(9)">Dagen tot gepland</th> <!-- huidige datum tov geplande datum !-->
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
