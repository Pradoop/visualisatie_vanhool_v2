<div id="table_title">
    <div id="afdelingNaam">
        <h1>Industriële Voertuigen: hal 5 en hal 6</h1>
    </div>
    <div id="searchBox">
        <input id="search_input" type="text" class="form-control" placeholder="Typ om te zoeken">
    </div>
    <div id="filter">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
            Filters
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownFilter">
            <li>
                <input id="Wagen-filter" class="form-check-input" type="checkbox" value="Wagen">
                <label class="form-check-label" for="Wagen-filter"><?= $chassis_info[0][0] ?></label>
            </li>
            <li>
                <input id="EW-filter" class="form-check-input" type="checkbox" value="EW">
                <label class="form-check-label" for="EW-filter"><?= $chassis_info[0][1] ?></label>
            </li>
            <li>
                <input id="Aantal-filter" class="form-check-input" type="checkbox" value="Aantal">
                <label class="form-check-label" for="Aantal-filter"><?= $chassis_info[0][2] ?></label>
            </li>
            <li>
                <input id="dtmGepland-filter" class="form-check-input" type="checkbox" value="dtmGepland">
                <label class="form-check-label" for="dtmGepland-filter"><?= $chassis_info[0][3] ?></label>
            </li>
            <li>
                <input id="Wagtyp-filter" class="form-check-input" type="checkbox" value="Wagtyp">
                <label class="form-check-label" for="Wagtyp-filter"><?= $chassis_info[0][4] ?></label>
            </li>
            <li>
                <input id="naamWagTyp-filter" class="form-check-input" type="checkbox" value="naamWagTyp">
                <label class="form-check-label" for="naamWagTyp-filter"><?= $chassis_info[0][5] ?></label>
            </li>
            <li>
                <input id="KlantNr-filter" class="form-check-input" type="checkbox" value="KlantNr">
                <label class="form-check-label" for="KlantNr-filter"><?= $chassis_info[0][6] ?></label>
            </li>
            <li>
                <input id="naamKlant-filter" class="form-check-input" type="checkbox" value="naamKlant">
                <label class="form-check-label" for="naamKlant-filter"><?= $chassis_info[0][7] ?></label>
            </li>
            <li>
                <input id="Land-filter" class="form-check-input" type="checkbox" value="Land">
                <label class="form-check-label" for="Land-filter"><?= $chassis_info[0][8] ?></label>
            </li>
            <li>
                <input id="LijnNr-filter" class="form-check-input" type="checkbox" value="LijnNr">
                <label class="form-check-label" for="LijnNr-filter"><?= $chassis_info[0][9] ?></label>
            </li>
            <li>
                <input id="ReeksVan-filter" class="form-check-input" type="checkbox" value="ReeksVan">
                <label class="form-check-label" for="ReeksVan-filter"><?= $chassis_info[0][10] ?></label>
            </li>
            <li>
                <input id="Afdeling-filter" class="form-check-input" type="checkbox" value="Afdeling">
                <label class="form-check-label" for="Afdeling-filter"><?= $chassis_info[0][11] ?></label>
            </li>
            <li>
                <input id="Galva-filter" class="form-check-input" type="checkbox" value="Galva">
                <label class="form-check-label" for="Galva-filter"><?= $chassis_info[0][12] ?></label>
            </li>
            <li>
                <input id="DLNR-filter" class="form-check-input" type="checkbox" value="DLNR">
                <label class="form-check-label" for="DLNR-filter"><?= $chassis_info[0][13] ?></label>
            </li>
            <li>
                <input id="Status-filter" class="form-check-input" type="checkbox" value="Status">
                <label class="form-check-label" for="Status-filter"><?= $chassis_info[0][14] ?></label>
            </li>
            <li>
                <input id="CntrDtm-filter" class="form-check-input" type="checkbox" value="CntrDtm">
                <label class="form-check-label" for="CntrDtm-filter"><?= $chassis_info[0][15] ?></label>
            </li>
            <li>
                <input id="wdTeLaat-filter" class="form-check-input" type="checkbox" value="wdTeLaat">
                <label class="form-check-label" for="wdTeLaat-filter"><?= $chassis_info[0][16] ?></label>
            </li>
            <li>
                <input id="wdInMont-filter" class="form-check-input" type="checkbox" value="wdInMont">
                <label class="form-check-label" for="wdInMont-filter"><?= $chassis_info[0][17] ?></label>
            </li>
            <li>
                <input id="standLas-filter" class="form-check-input" type="checkbox" value="standLas">
                <label class="form-check-label" for="standLas-filter"><?= $chassis_info[0][18] ?></label>
            </li>
        </ul>
    </div>
</div>
<div class="grid-container">
    <table>
        <thead>
        <tr>
            <th><?= $chassis_info[0][0] ?></th>
            <th><?= $chassis_info[0][2] ?></th>
            <th><?= $chassis_info[0][3] ?></th>
            <th><?= $chassis_info[0][5] ?></th>
            <th><?= $chassis_info[0][7] ?></th>
            <th><?= $chassis_info[0][9] ?></th>
            <th><?= $chassis_info[0][10] ?></th>
            <th><?= $chassis_info[0][14] ?></th>
            <th><?= $chassis_info[0][16] ?></th>
            <th><?= $chassis_info[0][17] ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $lijn_nr = 1; ?>
        <?php while($lijn_nr < sizeof($chassis_info)): ?>
            <tr>
                <td><?= $chassis_info[$lijn_nr][0] ?></td>
                <td><?= $chassis_info[$lijn_nr][2] ?></td>
                <td><?= $chassis_info[$lijn_nr][3] ?></td>
                <td><?= $chassis_info[$lijn_nr][5] ?></td>
                <td><?= $chassis_info[$lijn_nr][7] ?></td>
                <td><?= $chassis_info[$lijn_nr][9] ?></td>
                <td><?= $chassis_info[$lijn_nr][10] ?></td>
                <td><?= $chassis_info[$lijn_nr][14] ?></td>
                <td><?= $chassis_info[$lijn_nr][16] ?></td>
                <td><?= $chassis_info[$lijn_nr][17] ?></td>
            </tr>
            <?php $lijn_nr++; ?>
        <?php endwhile; ?>

        </tbody>
    </table>
</div>
