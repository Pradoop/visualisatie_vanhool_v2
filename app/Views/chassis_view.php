<div id="table_title">
    <div id="afdelingNaam_div">
        <div id="afdelingNaam">
        </div>
    </div>
    <div id="dropdownFilter_div" class="dropdown filter">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filter-dropdown-button" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
        </button>
        <ul class="dropdown-menu" aria-labelledby="filter-dropdown-button">
            <li><h6 class="dropdown-header">Galva/Meta</h6></li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="gegalvaniseerd-filter" checked>
                <label class="form-check-label" for="gegalvaniseerd-filter">Gegalvaniseerde wagens</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="gemetalliseerd-filter" checked>
                <label class="form-check-label" for="gemetalliseerd-filter">Gemetalliseerde wagens</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="geen-filter" checked>
                <label class="form-check-label" for="geen-filter">Geen van beide</label>
            </li>

            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header">Status</h6></li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-01-filter" checked>
                <label class="form-check-label" for="status-01-filter">Verkocht voertuig</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-02-filter" checked>
                <label class="form-check-label" for="status-02-filter">Studie is gestart</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-20-filter" checked>
                <label class="form-check-label" for="status-20-filter">Studie chassis is afgewerkt</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-03-filter" checked>
                <label class="form-check-label" for="status-03-filter">Studie volledig klaar, klaar voor werkvoorbereiding</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-04-filter" checked>
                <label class="form-check-label" for="status-04-filter">Serieploeg is gestart</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-40-filter" checked>
                <label class="form-check-label" for="status-40-filter">Prognosedatum prefab is bepaald</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-39-filter" checked>
                <label class="form-check-label" for="status-39-filter">Prognosedatum voor basisserie is bepaald</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-38-filter" checked>
                <label class="form-check-label" for="status-38-filter">Basisserieploeg en prefab klaar voor montage</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-07-filter" checked>
                <label class="form-check-label" for="status-07-filter">Gestart in de samenstelkaliber</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-83-filter" checked>
                <label class="form-check-label" for="status-83-filter">Uit de samenstelkaliber</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-85-filter" checked>
                <label class="form-check-label" for="status-85-filter">Gestart in de lasrobot</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-86-filter" checked>
                <label class="form-check-label" for="status-86-filter">Gestart met aflassen</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-8-filter" checked>
                <label class="form-check-label" for="status-8-filter">Morgen af in de montage afdeling</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-81-filter" checked>
                <label class="form-check-label" for="status-81-filter">Vandaag af in de montage afdeling</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-10-filter" checked>
                <label class="form-check-label" for="status-10-filter">Vloer afwerking chassis is voorbij montage</label>
            </li>
            <li>
                <input class="form-check-input overzicht-filter" type="checkbox" id="status-12-filter" checked>
                <label class="form-check-label" for="status-12-filter">Keuring chassis is voorbij montage</label>
            </li>
        </ul>
    </div>
    <div id="searchBox_div">
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
