<div id="table_title">
    <div id="afdelingNaam_div">
        <div id="afdelingNaam">
            <h1>
                Industriële Voertuigen: hal 5 en hal 6
                <input type="image" id="icon_i" class="info_icon" src="<?= base_url()?>/images/icons8-information-15.png" alt="...">
            </h1>
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
                <input class="form-check-input" type="checkbox" id="gegalvaniseerd-filter">
                <label class="form-check-label" for="gegalvaniseerd-filter">Gegalvaniseerde wagens</label>
            </li>
        </ul>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
</div>

<h2 class="inspect-data-loading">
    Bezig met laden...
</h2>

<div id="table_content">
    <table id="chassis_table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th id="th0">Gepland</th>
                <th id="th1">Wagen</th>
                <th id="th2">Wagentype</th>
                <th id="th3">Klant</th>
                <th id="th4">Reeks</th>
                <th id="th5">Galva/Meta</th>
                <th id="th6">DagenTot</th>
                <th id="th7">WdInMont</th>
                <th id="th8">Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php $row_id = 0; ?>
            <?php while($row_id < sizeof($aantal_lines)): ?>
                <tr id="<?= 'primary_'.$row_id ?>">
                    <?php
                        $array = preg_split('/!/', $aantal_lines[$row_id]);
                        echo "<td>{$array[0]}</td>";
                        echo "<td>{$array[1]}</td>";
                        echo "<td>{$array[2]}</td>";
                        echo "<td>{$array[3]}</td>";
                        echo "<td>{$array[4]}</td>";
                        echo "<td>{$array[5]}</td>";
                        echo "<td>{$array[6]}</td>";
                        echo "<td>{$array[7]}</td>";
                        echo match ($array[8]) {
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
    <div id="count_div">
        <p id="count_div_text">1 tot <?= sizeof($aantal_lines) ?> van <?= sizeof($aantal_lines) ?> resultaten</p>
    </div>
</div>
