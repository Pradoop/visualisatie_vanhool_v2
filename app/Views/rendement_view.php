<div id="table_title">
    <div id="afdelingNaam_div">
        <div id="afdelingNaam">
        </div>
    </div>
    <div id="dropdownFilter_div" class="dropdown filter">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filter-dropdown-button" data-bs-toggle="dropdown" aria-expanded="false" disabled>
            Filters
        </button>
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
            <th id="th0">Percentage</th>
            <th id="th1">Gewerkte uren</th>
            <th id="th2">Geplande uren</th>
            <th id="th3">Wagennummer</th>
            <th id="th4">Kaliber</th>
            <th id="th5">Klantnaam</th>
            <th id="th6">Naamtype</th>
            <th id="th7">Reekshoofd</th>
            <th id="th8">Reekseinde</th>
            <th id="th9">Land</th>
            <th id="th10">Datum opgezet</th>
            <th id="th11">Datum uit Montage</th>
        </tr>
        </thead>
        <tbody id="myTable">
        <?php $row_id = 0; ?>
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
                echo "<td>{$array[11]}</td>";
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
