<script> let galva_lines = <?php echo json_encode($galva_list); ?>;</script>

<div id="table_title">
    <div id="afdelingNaam_div">
        <div id="afdelingNaam">
            <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
        </div>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
</div>

<div id="info_div">
    <p>Gegalvaniseerde wagens zijn in het groen aangeduid.</p>
    <p>Gemetaliseerde wagens zijn in het geel aangeduid.</p>
</div>

<?php
    $primary_array = array();
    $secondary_array = array();
    $index = 0;
    while($index < sizeof($file_lines)) {
        $array = preg_split('/!/', $file_lines[$index]);
        $primary_array[] = $array;

        $array2 = preg_split('/!/', $extra_file_lines[$index]);
        $secondary_array[] = $array2;
        $index++;
    }
?>

<div id="table_content">
    <table id="chassis_table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th id="th0">Wagen</th>
                <th id="th1">Wagentype</th>
                <th id="th2">Klant</th>
                <th id="th3">Reeks</th>
                <th id="th4">Gepland</th>
                <th id="th5">DagenTot</th>
                <th id="th6">WdInMont</th>
                <th id="th7">Status (nr)</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php $row_id = 0; ?>
            <?php while($row_id < sizeof($primary_array)): ?>

                <tr id="<?= 'primary_'.$row_id ?>" onclick="showHideRow(<?= $row_id ?>);">
                    <?php
                        echo "<td>{$primary_array[$row_id][0]}</td>";
                        echo "<td>{$primary_array[$row_id][1]}</td>";
                        echo "<td>{$primary_array[$row_id][2]}</td>";
                        echo "<td>{$primary_array[$row_id][3]}</td>";
                        echo "<td>{$primary_array[$row_id][4]}</td>";
                        echo "<td>{$primary_array[$row_id][5]}</td>";
                        echo "<td>{$primary_array[$row_id][6]}</td>";
                        echo match ($primary_array[$row_id][7]) {
                            "01" => "<td>Verkocht voertuig</td>",
                            "02" => "<td>Studie is gestart</td>",
                            "20" => "<td>Studie chassis is afgewerkt</td>",
                            "03" => "<td>Studie volledig klaar, klaar voor werkvoorbereiding</td>",
                            "04" => "<td>Serieploeg is gestart</td>",
                            "40" => "<td>Prognosedatum prefab is bepaald</td>",
                            "39" => "<td>Prognosedatum voor basisserie is bepaald</td>",
                            "38" => "<td>Basisserieploeg en prefab klaar voor montage</td>",
                            "07" => "<td>Gestart in de samenstelkaliber</td>",
                            "83" => "<td>Uit de samenstelkaliber</td>",
                            "85" => "<td>Gestart in de lasrobot</td>",
                            "86" => "<td>Gestart met aflassen</td>",
                            "8" => "<td>Morgen af in de montage afdeling</td>",
                            "81" => "<td>Vandaag af in de montage afdeling</td>",
                            "10" => "<td>Vloer afwerking chassis is voorbij montage</td>",
                            "12" => "<td>Keuring chassis is voorbij montage</td>",
                            default => "<td>Nog te implementeren</td>",
                        };
                    ?>
                </tr>

                <?php $row_id++; ?>

            <?php endwhile; ?>
        </tbody>
    </table>
</div>
