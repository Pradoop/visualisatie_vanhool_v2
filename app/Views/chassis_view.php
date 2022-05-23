<script> let galva_lines = <?php echo json_encode($galva_list); ?>;</script>

<div id="table_title">
    <div id="afdelingNaam">
        <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
</div>

<?php
    $primary_array = array();
    $secondary_array = array();
    $index = 0;
    while($index < sizeof($file_lines)) {
        $array = preg_split('/!/', $file_lines[$index]);
        array_push($primary_array, $array);

        $array2 = preg_split('/!/', $extra_file_lines[$index]);
        array_push($secondary_array, $array2);
        $index++;
    }
?>

<div id="table_content">
    <table id="chassis_table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th id="th0">Wagen</th>
                <th id="th1">WagenTyp (nr)</th>
                <th id="th2">Klant (nr)</th>
                <th id="th3">Reeks</th>
                <th id="th4">Gepland</th>
                <th id="th5">DagenTot</th>
                <th id="th6">WdInMont</th>
                <th id="th7">Status</th>
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
                        switch($primary_array[$row_id][7]) {
                            case "01":
                                echo "<td>Verkocht voertuig ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "02":
                                echo "<td>Studie is gestart ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "20":
                                echo "<td>Studie chassis is afgewerkt ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "03":
                                echo "<td>Studie volledig klaar, klaar voor werkvoorbereiding ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "04":
                                echo "<td>Serieploeg is gestart ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "40":
                                echo "<td>Prognosedatum prefab is bepaald ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "39":
                                echo "<td>Prognosedatum voor basisserie is bepaald ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "38":
                                echo "<td>Basisserieploeg en prefab klaar voor montage ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "07":
                                echo "<td>Gestart in de samenstelkaliber ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "83":
                                echo "<td>Uit de samenstelkaliber ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "85":
                                echo "<td>Gestart in de lasrobot ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "86":
                                echo "<td>Gestart met aflassen ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "8":
                                echo "<td>Morgen af in de montage afdeling ({$primary_array[$row_id][7]})</td>";
                                break;
                            case "81":
                                echo "<td>Vandaag af in de montage afdeling ({$primary_array[$row_id][7]})</td>";
                        }
                    ?>
                </tr>

                <tr id="<?= 'secondary_'.$row_id?>" class="hidden_row">
                    <?php
                        echo "<td>{$secondary_array[$row_id][0]}</td>";
                        echo "<td>{$secondary_array[$row_id][1]}</td>";
                        echo "<td>{$secondary_array[$row_id][2]}</td>";
                        echo "<td>{$secondary_array[$row_id][3]}</td>";
                        echo "<td>{$secondary_array[$row_id][4]}</td>";
                        echo "<td>{$secondary_array[$row_id][5]}</td>";
                        echo "<td>{$secondary_array[$row_id][6]}</td>";
                        echo "<td>{$secondary_array[$row_id][7]}</td>";
                    ?>
                </tr>

                <?php $row_id++; ?>

            <?php endwhile; ?>
        </tbody>
    </table>
</div>
