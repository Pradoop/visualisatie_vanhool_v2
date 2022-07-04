<div id="table_title">
    <div id="afdelingNaam_div">
        <div id="afdelingNaam">
            <h1>
                Industriële Voertuigen: hal 5 en hal 6
            </h1>
        </div>
    </div>
    <div id="dropdownFilter_div" class="dropdown filter">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filter-dropdown-button" data-bs-toggle="dropdown" aria-expanded="false" disabled>
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

            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header">Wagentypes</h6></li>

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

            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header">Klant</h6></li>

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
            <th id="th0">Wagennummer</th>
            <th id="th1">Datum in Montage</th>
            <th id="th2">Datum uit Montage</th>
            <th id="th3">Kaliber</th>
            <th id="th4">Gewerkte uren</th>
            <th id="th5">Geplande uren</th>
            <th id="th6">Klantnaam</th>
            <th id="th7">Naamtype</th>
            <th id="th8">Land</th>
            <th id="th9">Reekshoofd</th>
            <th id="th10">Reekseinde</th>
        </tr>
        </thead>
        <tbody id="myTable">
        <?php $row_id = 1; ?>
        <?php while($row_id < sizeof($data_lines)): ?>
            <tr id="<?= 'primary_'.$row_id ?>">
                <?php
                $array = preg_split('/!/', $data_lines[$row_id]);
                echo "<td>{$array[0]}</td>";
                echo "<td>{$array[1]}</td>";
                echo "<td>{$array[2]}</td>";
                echo "<td>{$array[3]}</td>";
                echo "<td>{$array[4]}</td>";
                echo "<td>{$array[5]}</td>";
                echo "<td>{$array[6]}</td>";
                echo "<td>{$array[7]}</td>";
                echo "<td>{$array[8]}</td>";
                echo "<td>{$array[9]}</td>";
                echo "<td>{$array[10]}</td>";
                ?>
            </tr>
            <?php $row_id++; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <div id="count_div">
        <p id="count_div_text">1 tot <?= sizeof($data_lines) ?> van <?= sizeof($data_lines) ?> resultaten</p>
    </div>
</div>
